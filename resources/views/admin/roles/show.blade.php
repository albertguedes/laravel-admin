@php
/**
 * Role Show View
 *
 * @var \Spatie\Permission\Models\Role $role
 */
@endphp

<x-admin.layouts.admin title="Role Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Role Details</h1>
        <a href="{{ route('admin.roles.index') }}" class="text-blue-600 hover:text-blue-900">Back to List</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4">
            <label class="font-semibold text-gray-700">ID:</label>
            <p class="text-gray-900">{{ $role->id }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Name:</label>
            <p class="text-gray-900">{{ $role->name }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Description:</label>
            <p class="text-gray-900">{{ $role->description ?? '—' }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Permissions:</label>
            <div class="mt-1 flex flex-wrap">
                @forelse($role->permissions as $perm)
                    <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1 mb-1">{{ $perm->name }}</span>
                @empty
                    <span class="text-gray-400">No permissions assigned</span>
                @endforelse
            </div>
        </div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.roles.edit', $role) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                onsubmit="return confirm('Delete this role?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
</x-admin.layouts.admin>
