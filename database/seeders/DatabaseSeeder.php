<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create()->each(function ($user) {
            if ($user->role === 'admin') {
                Admin::factory()->create(['user_id' => $user->id]);
            } elseif ($user->role === 'student') {
                Student::factory()->create(['user_id' => $user->id]);
            } elseif ($user->role === 'teacher') {
                Teacher::factory()->create(['user_id' => $user->id]);
            }
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
