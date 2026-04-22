@php
/**
 * Roles Index View
 *
 * @var \Illuminate\Database\Eloquent\Collection $roles
 * @var string|null $search
 */
@endphp

<x-admin.layouts.admin title="Manage Roles">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Roles</h1>
        <a href="{{ route('admin.roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create Role
        </a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search roles..."
            class="border rounded px-3 py-2 w-64">
        <button type="submit" class="bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600">Search</button>
        <a href="{{ route('admin.roles.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Clear</a>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Permissions</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($roles as $role)
                <tr>
                    <td class="px-6 py-4">{{ $role->id }}</td>
                    <td class="px-6 py-4">{{ $role->name }}</td>
                    <td class="px-6 py-4">{{ $role->description ?? '—' }}</td>
                    <td class="px-6 py-4">
                        @forelse($role->permissions->take(3) as $perm)
                            <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $perm->name }}</span>
                        @empty
                            <span class="text-gray-400">No permissions</span>
                        @endforelse
                        @if($role->permissions->count() > 3)
                            <span class="text-gray-400">+{{ $role->permissions->count() - 3 }} more</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.roles.show', $role) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="inline"
                            onsubmit="return confirm('Delete this role?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No roles found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $roles->withQueryString()->links() }}
    </div>
</x-admin.layouts.admin>
