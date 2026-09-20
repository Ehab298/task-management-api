<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $instructor;

    private User $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        $this->instructor = User::create([
            'name' => 'Instructor',
            'email' => 'instructor@test.com',
            'password' => 'password',
            'role' => User::ROLE_INSTRUCTOR,
        ]);

        $this->student = User::create([
            'name' => 'Student',
            'email' => 'student@test.com',
            'password' => 'password',
            'role' => User::ROLE_STUDENT,
        ]);
    }

    public function test_admin_can_view_student_pages(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/students')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->get('/admin/students/create')
            ->assertStatus(200);
    }

    public function test_admin_can_view_instructor_pages(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/instructors')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->get('/admin/instructors/create')
            ->assertStatus(200);
    }

    public function test_admin_can_view_and_edit_student_records(): void
    {
        $this->actingAs($this->admin)
            ->get("/admin/students/{$this->student->id}")
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->get("/admin/students/{$this->student->id}/edit")
            ->assertStatus(200);
    }

    public function test_instructor_cannot_access_admin_panel(): void
    {
        $this->actingAs($this->instructor)
            ->get('/admin/students')
            ->assertStatus(403);

        $this->actingAs($this->instructor)
            ->get('/admin/instructors')
            ->assertStatus(403);
    }

    public function test_student_cannot_access_admin_panel(): void
    {
        $this->actingAs($this->student)
            ->get('/admin/students')
            ->assertStatus(403);
    }

    public function test_admin_can_create_student_via_api(): void
    {
        $token = $this->admin->createToken('test')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/students', [
                'name' => 'New Student',
                'email' => 'new.student@test.com',
                'password' => 'secret12345',
                'password_confirmation' => 'secret12345',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.role', User::ROLE_STUDENT);

        $this->assertDatabaseHas('users', [
            'email' => 'new.student@test.com',
            'role' => User::ROLE_STUDENT,
        ]);
    }

    public function test_instructor_cannot_create_student_via_api(): void
    {
        $token = $this->instructor->createToken('test')->plainTextToken;

        $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/students', [
                'name' => 'New Student',
                'email' => 'new.student2@test.com',
                'password' => 'secret12345',
                'password_confirmation' => 'secret12345',
            ])
            ->assertStatus(403);
    }
}
