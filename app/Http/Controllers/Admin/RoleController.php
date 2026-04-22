<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $roles = Role::when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->paginate(15);

        return view('admin.roles.index', [
            'roles' => $roles,
            'search' => $request->search,
        ]);
    }

    public function create(): View
    {
        return view('admin.roles.create', ['role' => new Role]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['array'],
        ]);

        $role = Role::create(['name' => $validated['name'], 'description' => $validated['description'] ?? null]);

        if (! empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role): View
    {
        return view('admin.roles.show', ['role' => $role->load('permissions')]);
    }

    public function edit(Role $role): View
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $role->getPermissionNames(),
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,'.$role->id],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['array'],
        ]);

        $role->update($validated);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.edit', $role)
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
