<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('user.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'business_name' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'turnaround_time' => 'nullable|string|max:255',
            'product_details' => 'nullable|string|max:5000',
            'business_address' => 'nullable|string|max:1000',
            'address_street' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_country' => 'nullable|string|max:255',
            'address_postal' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
            
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }

    public function uploadDocuments(Request $request)
    {
        $validated = $request->validate([
            'documents' => 'required|array|min:1|max:5',
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png,webp,doc,docx|max:10240',
        ]);

        $user = auth()->user();
        $documents = $user->business_documents ?? [];

        foreach ($validated['documents'] as $file) {
            $documentId = (string) Str::uuid();
            $storedName = $documentId.'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('business-documents/'.$user->id, $storedName, 'local');

            if (! $path) {
                throw new \RuntimeException('The business document could not be saved.');
            }

            $documents[$documentId] = [
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'uploaded_at' => now()->toISOString(),
            ];
        }

        $user->business_documents = $documents;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Business documents uploaded successfully.');
    }

    public function downloadDocument(string $document)
    {
        $user = auth()->user();
        $documents = $user->business_documents ?? [];
        abort_unless(isset($documents[$document]), 404);

        $file = $documents[$document];
        abort_unless(isset($file['path'], $file['name']), 404);
        abort_unless(Storage::disk('local')->exists($file['path']), 404);

        return Storage::disk('local')->download($file['path'], basename($file['name']));
    }

    public function viewDocument(string $document)
    {
        $user = auth()->user();
        $documents = $user->business_documents ?? [];
        abort_unless(isset($documents[$document]), 404);

        $file = $documents[$document];
        abort_unless(isset($file['path'], $file['name']), 404);
        abort_unless(Storage::disk('local')->exists($file['path']), 404);

        $mimeType = Storage::disk('local')->mimeType($file['path']);
        if (! in_array($mimeType, ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'], true)) {
            return Storage::disk('local')->download($file['path'], basename($file['name']));
        }

        return Storage::disk('local')->response(
            $file['path'],
            basename($file['name']),
            [
                'Content-Type' => $mimeType,
                'X-Content-Type-Options' => 'nosniff',
                'Content-Security-Policy' => 'sandbox',
            ],
            'inline'
        );
    }

    public function deleteDocument(string $document)
    {
        $user = auth()->user();
        $documents = $user->business_documents ?? [];
        abort_unless(isset($documents[$document]), 404);

        $file = $documents[$document];
        if (isset($file['path']) && Storage::disk('local')->exists($file['path'])) {
            if (! Storage::disk('local')->delete($file['path'])) {
                Log::error('Unable to delete customer business document.', [
                    'user_id' => $user->id,
                    'document_id' => $document,
                ]);

                return redirect()->route('user.profile')
                    ->with('error', 'The document could not be deleted. Please try again.');
            }
        }

        unset($documents[$document]);
        $user->business_documents = $documents;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Business document deleted successfully.');
    }
}
