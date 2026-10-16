<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('hobbies')->latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'hobbies'   => 'nullable|array',
            'hobbies.*' => 'nullable|string|max:100',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->filled('hobbies')) {
            foreach ($request->hobbies as $hobby) {
                if (trim($hobby) !== '') {
                    $user->hobbies()->create(['name' => $hobby]);
                }
            }
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $user->load('hobbies');
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6',
            'hobbies'   => 'nullable|array',
            'hobbies.*' => 'nullable|string|max:100',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->hobbies()->delete();

        if ($request->filled('hobbies')) {
            foreach ($request->hobbies as $hobby) {
                if (trim($hobby) !== '') {
                    $user->hobbies()->create(['name' => $hobby]);
                }
            }
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
