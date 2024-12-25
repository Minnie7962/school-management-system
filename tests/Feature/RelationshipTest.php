<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;

class RelationshipTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUserHasOneAdmin()
    {
        $user = User::factory()->create();
        $admin = Admin::factory()->create(['user_id' => $user->id]);
        
        $this->assertEquals($admin->id, $user->admin->id);
    }

    public function testUserHasOneStudent()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create(['user_id' => $user->id]);
        
        $this->assertEquals($student->id, $user->student->id);
    }
}
