<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        return 'User created successfully!';
    }
}
