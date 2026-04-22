<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_roles_index_requires_authentication(): void
    {
        $response = $this->get('/admin/roles');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_create_role(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/roles', [
            'name' => 'editor',
            'description' => 'Can edit content',
        ]);

        $this->assertDatabaseHas('roles', ['name' => 'editor']);
    }

    public function test_admin_can_view_role(): void
    {
        $admin = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        $response = $this->actingAs($admin)->get("/admin/roles/{$role->id}");
        $response->assertStatus(200);
        $response->assertSee('admin');
    }

    public function test_admin_can_update_role(): void
    {
        $admin = User::factory()->create();
        $role = Role::create(['name' => 'editor']);

        $response = $this->actingAs($admin)->put("/admin/roles/{$role->id}", [
            'name' => 'senior-editor',
            'description' => 'Updated description',
        ]);

        $this->assertDatabaseHas('roles', ['name' => 'senior-editor']);
    }

    public function test_admin_can_delete_role(): void
    {
        $admin = User::factory()->create();
        $role = Role::create(['name' => 'temp']);

        $response = $this->actingAs($admin)->delete("/admin/roles/{$role->id}");

        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
