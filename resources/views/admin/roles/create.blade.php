@php
/**
 * Create/Edit Role Form View
 *
 * @var \Spatie\Permission\Models\Role $role
 * @var array $permissions
 */
@endphp

<x-admin.layouts.admin title="{{ $role->exists ? 'Edit Role' : 'Create Role' }}">
    <h1 class="text-2xl font-bold mb-6">{{ $role->exists ? 'Edit Role' : 'Create Role' }}</h1>

    <form method="POST" action="{{ $role->exists ? route('admin.roles.update', $role) : route('admin.roles.store') }}"
        class="bg-white p-6 rounded-lg shadow max-w-lg">
        @csrf
        @if($role->exists) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}"
                class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="3"
                class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description', $role->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Permissions</label>
            <div class="space-y-2 max-h-60 overflow-y-auto border rounded p-3">
                @forelse(\Spatie\Permission\Models\Permission::all() as $perm)
                    <label class="flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                            {{ in_array($perm->name, old('permissions', $permissions ?? [])) ? 'checked' : '' }}
                            class="mr-2">
                        <span class="text-gray-700">{{ $perm->name }}</span>
                    </label>
                @empty
                    <p class="text-gray-500 text-sm">No permissions available.</p>
                @endforelse
            </div>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ $role->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.roles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</x-admin.layouts.admin>
