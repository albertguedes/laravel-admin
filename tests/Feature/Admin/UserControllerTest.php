<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_users_index_requires_authentication(): void
    {
        $response = $this->get('/admin/users');
        $response->assertRedirect('/login');
    }

    public function test_admin_users_index_displays_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_admin_can_create_user(): void
    {
        $admin = User::factory()->create();
        Role::create(['name' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_admin_can_view_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/admin/users/{$user->id}");
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_admin_can_update_user(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->put("/admin/users/{$admin->id}", [
            'name' => 'Updated Name',
            'email' => $admin->email,
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    public function test_admin_can_delete_user(): void
    {
        $admin = User::factory()->create();
        $userToDelete = User::factory()->create();

        $response = $this->actingAs($admin)->delete("/admin/users/{$userToDelete->id}");

        $this->assertSoftDeleted('users', ['id' => $userToDelete->id]);
    }
}
