<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        $validate = request()->validate([
            'login_name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('login_name', $validate['login_name'])->first();
        if ($user && Hash::check($validate['password'], $user->hash_password)) {
            return response()->json(['message' => 'Login successful'], 200);
        } else {
            return response()->json(['message' => 'Login failed'], 401);
        }

    }

    public function register()
    {
        $validate = request()->validate([
            'display_name' => 'required|string|min:3|max:25',
            'login_name' => 'required|string|min:3|max:25',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:6|max:32',
        ]);

        User::create([
            'display_name' => $validate['display_name'],
            'login_name' => $validate['login_name'],
            'email' => $validate['email'],
            'hash_password' => $validate['password'],
        ]);

    }
}
