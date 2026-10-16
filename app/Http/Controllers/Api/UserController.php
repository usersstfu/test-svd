<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('hobbies')->latest()->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'hobbies'   => 'nullable|array',
            'hobbies.*' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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

        return response()->json($user->load('hobbies'), 201);
    }

    public function show(User $user)
    {
        return response()->json($user->load('hobbies'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6',
            'hobbies'   => 'nullable|array',
            'hobbies.*' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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

        return response()->json($user->load('hobbies'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
