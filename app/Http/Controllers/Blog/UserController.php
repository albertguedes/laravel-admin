<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private BlogApiService $blogApi) {}

    public function index(Request $request): View
    {
        $data = $this->blogApi->getUsers(['page' => $request->get('page', 1), 'per_page' => 15]);

        return view('admin.blog.users.index', [
            'users' => $data['data'] ?? [],
            'meta' => $data['meta'] ?? [],
            'search' => $request->get('search'),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.users.create', ['user' => null, 'roles' => $this->fetchRoles()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'about' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
            'is_admin' => ['boolean'],
            'roles' => ['array'],
        ]);

        $result = $this->blogApi->createUser($data);

        if ($result) {
            return redirect()->route('admin.blog.users.index')
                ->with('success', 'User created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create user.');
    }

    public function show(int $id): View
    {
        $data = $this->blogApi->getUser($id);

        return view('admin.blog.users.show', ['user' => $data['data'] ?? null]);
    }

    public function edit(int $id): View
    {
        $data = $this->blogApi->getUser($id);

        return view('admin.blog.users.edit', [
            'user' => $data['data'] ?? null,
            'roles' => $this->fetchRoles(),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255'],
            'username' => ['sometimes', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'about' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
            'is_admin' => ['boolean'],
            'roles' => ['array'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $result = $this->blogApi->updateUser($id, $data);

        if ($result) {
            return redirect()->route('admin.blog.users.edit', $id)
                ->with('success', 'User updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update user.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $result = $this->blogApi->deleteUser($id);

        if ($result) {
            return redirect()->route('admin.blog.users.index')
                ->with('success', 'User deleted successfully.');
        }

        return redirect()->route('admin.blog.users.index')
            ->with('error', 'Failed to delete user.');
    }

    private function fetchRoles(): array
    {
        $data = $this->blogApi->getRoles(['per_page' => 100]);

        return $data['data'] ?? [];
    }
}
