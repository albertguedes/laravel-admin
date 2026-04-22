<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogApiService
{
    private ?string $baseUrl;

    private ?string $token;

    public function __construct(?string $baseUrl = null, ?string $token = null)
    {
        $this->baseUrl = $baseUrl ?? config('admin.blog_api_url');
        $this->token = $token ?? config('admin.blog_api_token');
    }

    private function client(): PendingRequest
    {
        return Http::withToken($this->token)->timeout(10);
    }

    public function setCredentials(string $baseUrl, string $token): self
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;

        return $this;
    }

    private function get(string $endpoint, array $query = []): ?array
    {
        try {
            $response = $this->client()->get("{$this->baseUrl}/{$endpoint}", $query);

            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('BlogApiService GET error: '.$e->getMessage());

            return null;
        }
    }

    private function post(string $endpoint, array $data = []): ?array
    {
        try {
            $response = $this->client()->post("{$this->baseUrl}/{$endpoint}", $data);

            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('BlogApiService POST error: '.$e->getMessage());

            return null;
        }
    }

    private function put(string $endpoint, array $data = []): ?array
    {
        try {
            $response = $this->client()->put("{$this->baseUrl}/{$endpoint}", $data);

            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('BlogApiService PUT error: '.$e->getMessage());

            return null;
        }
    }

    private function delete(string $endpoint): ?array
    {
        try {
            $response = $this->client()->delete("{$this->baseUrl}/{$endpoint}");

            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('BlogApiService DELETE error: '.$e->getMessage());

            return null;
        }
    }

    public function getUsers(array $query = []): ?array
    {
        return $this->get('admin/users', $query);
    }

    public function getUser(int $id): ?array
    {
        return $this->get("admin/users/{$id}");
    }

    public function createUser(array $data): ?array
    {
        return $this->post('admin/users', $data);
    }

    public function updateUser(int $id, array $data): ?array
    {
        return $this->put("admin/users/{$id}", $data);
    }

    public function deleteUser(int $id): ?array
    {
        return $this->delete("admin/users/{$id}");
    }

    public function getRoles(array $query = []): ?array
    {
        return $this->get('admin/roles', $query);
    }

    public function getRole(int $id): ?array
    {
        return $this->get("admin/roles/{$id}");
    }

    public function createRole(array $data): ?array
    {
        return $this->post('admin/roles', $data);
    }

    public function updateRole(int $id, array $data): ?array
    {
        return $this->put("admin/roles/{$id}", $data);
    }

    public function deleteRole(int $id): ?array
    {
        return $this->delete("admin/roles/{$id}");
    }

    public function getPosts(array $query = []): ?array
    {
        return $this->get('admin/posts', $query);
    }

    public function getPost(int $id): ?array
    {
        return $this->get("admin/posts/{$id}");
    }

    public function createPost(array $data): ?array
    {
        return $this->post('admin/posts', $data);
    }

    public function updatePost(int $id, array $data): ?array
    {
        return $this->put("admin/posts/{$id}", $data);
    }

    public function deletePost(int $id): ?array
    {
        return $this->delete("admin/posts/{$id}");
    }

    public function getCategories(array $query = []): ?array
    {
        return $this->get('admin/categories', $query);
    }

    public function getCategory(int $id): ?array
    {
        return $this->get("admin/categories/{$id}");
    }

    public function createCategory(array $data): ?array
    {
        return $this->post('admin/categories', $data);
    }

    public function updateCategory(int $id, array $data): ?array
    {
        return $this->put("admin/categories/{$id}", $data);
    }

    public function deleteCategory(int $id): ?array
    {
        return $this->delete("admin/categories/{$id}");
    }

    public function getTags(array $query = []): ?array
    {
        return $this->get('admin/tags', $query);
    }

    public function getTag(int $id): ?array
    {
        return $this->get("admin/tags/{$id}");
    }

    public function createTag(array $data): ?array
    {
        return $this->post('admin/tags', $data);
    }

    public function updateTag(int $id, array $data): ?array
    {
        return $this->put("admin/tags/{$id}", $data);
    }

    public function deleteTag(int $id): ?array
    {
        return $this->delete("admin/tags/{$id}");
    }
}
