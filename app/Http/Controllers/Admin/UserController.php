<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with('roles')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%"))
            ->paginate(15);

        return view('admin.users.index', [
            'users' => $users,
            'search' => $request->search,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'user' => new User,
            'roles' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'is_active' => ['boolean'],
            'roles' => ['array'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        if (! empty($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user): View
    {
        return view('admin.users.show', ['user' => $user->load('roles')]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $user->getRoleNames(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'is_active' => ['boolean'],
            'roles' => ['array'],
        ]);

        $user->fill($validated);

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        } else {
            unset($user->password);
        }

        $user->save();

        $user->syncRoles($validated['roles'] ?? []);

        return redirect()->route('admin.users.edit', $user)
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
