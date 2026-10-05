<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            // 'business_type' => 'nullable|string|max:255',
            // 'turnaround_time' => 'nullable|string|max:255',
            'product_details' => 'nullable|string',
            // 'business_address' => 'nullable|string',
            'address_street' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
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
}
