<?php

namespace App\Http\Controllers;

use App\Models\VerificationDocument;
use App\Models\VerificationDocumentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $documentTypes = VerificationDocumentType::query()
            ->where('role', $user->role)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $documents = $user->verificationDocuments()->with('documentType')->get()->keyBy('document_type_id');

        return view('verification.index', compact('documentTypes', 'documents', 'user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validate([
            'document_type_id' => [
                'required',
                'integer',
                Rule::exists('verification_document_types', 'id')
                    ->where('role', $user->role)
                    ->where('is_active', true),
            ],
            'document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
        ]);

        $existing = $user->verificationDocuments()
            ->where('document_type_id', $data['document_type_id'])
            ->first();
        if ($existing && $existing->status !== 'rejected') {
            return back()->withErrors([
                'document' => $existing->status === 'approved'
                    ? 'This document has already been approved.'
                    : 'This document is awaiting admin review.',
            ]);
        }

        $file = $data['document'];
        $path = $file->storeAs(
            'verification-documents/'.$user->id,
            Str::uuid().'.'.$file->extension(),
            'local'
        );
        if (! $path) {
            throw new \RuntimeException('The verification document could not be saved.');
        }

        if ($existing) {
            $oldPath = $existing->path;
            $existing->update([
                'path' => $path,
                'original_name' => basename($file->getClientOriginalName()),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'status' => 'pending',
                'admin_note' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
            ]);
            if (Storage::disk('local')->exists($oldPath) && ! Storage::disk('local')->delete($oldPath)) {
                Log::error('Unable to delete the replaced verification document.', [
                    'user_id' => $user->id,
                    'verification_document_id' => $existing->id,
                ]);
            }
        } else {
            $user->verificationDocuments()->create([
                'document_type_id' => $data['document_type_id'],
                'path' => $path,
                'original_name' => basename($file->getClientOriginalName()),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'Document submitted securely and is awaiting admin review.');
    }

    public function download(Request $request, VerificationDocument $document)
    {
        abort_unless($document->user_id === $request->user()->id, 404);
        abort_unless(Storage::disk('local')->exists($document->path), 404);

        return Storage::disk('local')->download($document->path, basename($document->original_name));
    }
}
