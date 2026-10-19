<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationDocument;
use App\Models\VerificationDocumentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VerificationController extends Controller
{
    private const ROLES = ['customer', 'vendor', 'channel_partner'];

    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', Rule::in(['pending', 'approved', 'rejected'])],
            'role' => ['nullable', Rule::in(self::ROLES)],
        ]);
        $documents = VerificationDocument::query()
            ->with(['user', 'documentType'])
            ->when(isset($filters['status']), fn ($query) => $query->where('status', $filters['status']))
            ->when(isset($filters['role']), fn ($query) => $query->whereHas('user', fn ($users) => $users->where('role', $filters['role'])))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.verification.index', compact('documents', 'filters'));
    }

    public function document(VerificationDocument $document)
    {
        abort_unless(Storage::disk('local')->exists($document->path), 404);

        $mimeType = Storage::disk('local')->mimeType($document->path);
        if (! in_array($mimeType, ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'], true)) {
            return Storage::disk('local')->download($document->path, basename($document->original_name));
        }

        return Storage::disk('local')->response(
            $document->path,
            basename($document->original_name),
            [
                'Content-Type' => $mimeType,
                'X-Content-Type-Options' => 'nosniff',
                'Content-Security-Policy' => 'sandbox',
            ],
            'inline'
        );
    }

    public function review(Request $request, VerificationDocument $document): RedirectResponse
    {
        $data = $request->validate([
            'decision' => ['required', Rule::in(['approved', 'rejected'])],
            'admin_note' => ['required_if:decision,rejected', 'nullable', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($request, $document, $data) {
            $lockedDocument = VerificationDocument::query()
                ->whereKey($document->id)
                ->lockForUpdate()
                ->firstOrFail();
            $lockedDocument->update([
                'status' => $data['decision'],
                'admin_note' => $data['decision'] === 'rejected' ? $data['admin_note'] : null,
                'reviewed_by' => $request->user('admin')->id,
                'reviewed_at' => now(),
            ]);
        });

        return back()->with('success', 'Verification document marked '.strtolower($data['decision']).'.');
    }

    public function types(): View
    {
        $types = VerificationDocumentType::query()
            ->withCount('documents')
            ->orderBy('role')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.verification.types', ['types' => $types, 'roles' => self::ROLES]);
    }

    public function storeType(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(self::ROLES)],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'is_required' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
        ]);
        $this->validateUniqueType($data['role'], $data['name']);
        VerificationDocumentType::create($data);

        return back()->with('success', 'Verification document requirement added.');
    }

    public function updateType(Request $request, VerificationDocumentType $type): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(self::ROLES)],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'is_required' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
        ]);
        $this->validateUniqueType($data['role'], $data['name'], $type->id);
        $type->update($data);

        return back()->with('success', 'Verification document requirement updated.');
    }

    private function validateUniqueType(string $role, string $name, ?int $ignoreId = null): void
    {
        $exists = VerificationDocumentType::query()
            ->where('role', $role)
            ->where('name', $name)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists();

        if ($exists) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'name' => 'This document requirement already exists for that account type.',
            ]);
        }
    }
}
