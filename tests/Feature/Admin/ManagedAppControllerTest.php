<?php

namespace Tests\Feature\Admin;

use App\Models\ManagedApp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagedAppControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_apps_index_requires_authentication(): void
    {
        $response = $this->get('/admin/apps');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_create_app(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/apps', [
            'name' => 'Blog',
            'slug' => 'blog',
            'api_url' => 'http://localhost:8000/api',
            'api_token' => 'test-token-123',
        ]);

        $this->assertDatabaseHas('managed_apps', ['slug' => 'blog']);
    }

    public function test_admin_can_view_app(): void
    {
        $admin = User::factory()->create();
        $app = ManagedApp::create([
            'name' => 'Blog',
            'slug' => 'blog',
            'api_url' => 'http://localhost:8000/api',
        ]);

        $response = $this->actingAs($admin)->get("/admin/apps/{$app->id}");
        $response->assertStatus(200);
        $response->assertSee('Blog');
    }

    public function test_admin_can_update_app(): void
    {
        $admin = User::factory()->create();
        $app = ManagedApp::create([
            'name' => 'Blog',
            'slug' => 'blog',
            'api_url' => 'http://localhost:8000/api',
        ]);

        $response = $this->actingAs($admin)->put("/admin/apps/{$app->id}", [
            'name' => 'Updated Blog',
            'slug' => 'blog',
            'api_url' => 'http://localhost:8000/api',
        ]);

        $this->assertDatabaseHas('managed_apps', ['name' => 'Updated Blog']);
    }

    public function test_admin_can_delete_app(): void
    {
        $admin = User::factory()->create();
        $app = ManagedApp::create([
            'name' => 'Blog',
            'slug' => 'blog',
            'api_url' => 'http://localhost:8000/api',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/apps/{$app->id}");

        $this->assertDatabaseMissing('managed_apps', ['id' => $app->id]);
    }
}
