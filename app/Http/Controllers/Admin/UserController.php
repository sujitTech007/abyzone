<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:customer,vendor,admin,super_admin',
            'status' => 'nullable|boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['status'] = isset($data['status']) ? 1 : 0;

        $user = User::create($data);

        // Send notification to admin about new user
        NotificationHelper::newUserRegistered(auth('admin')->id(), $user->name, $user->role);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $oldStatus = $user->status;

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'nullable|boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $data['status'] = isset($data['status']) ? 1 : 0;

        $user->update($data);

        // Send notification if status changed
        if ($oldStatus != $data['status']) {
            NotificationHelper::userStatusChanged($user->id, $user->name, $user->role, $data['status']);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted');
    }
}
