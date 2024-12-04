<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'student'
        ]);
    }

    public function updateUserStatus(User $user, bool $status)
    {
        $user->is_active = $status;
        $user->save();
        return $user;
    }
}
