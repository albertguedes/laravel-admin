@php
/**
 * Create/Edit User Form View
 *
 * @var \App\Models\User $user
 * @var array $roles
 */
@endphp

<x-admin.layouts.admin title="{{ $user->exists ? 'Edit User' : 'Create User' }}">
    <h1 class="text-2xl font-bold mb-6">{{ $user->exists ? 'Edit User' : 'Create User' }}</h1>

    <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
        class="bg-white p-6 rounded-lg shadow max-w-lg">
        @csrf
        @if($user->exists) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror" required>
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password {{ $user->exists ? '(leave blank to keep)' : '' }}</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror"
                {{ $user->exists ? '' : 'required' }}>
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
                    class="mr-2">
                <span class="text-gray-700 text-sm">Active</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Roles</label>
            <div class="space-y-2">
                @forelse(\Spatie\Permission\Models\Role::all() as $role)
                    <label class="flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                            {{ in_array($role->name, old('roles', $roles ?? [])) ? 'checked' : '' }}
                            class="mr-2">
                        <span class="text-gray-700">{{ $role->name }}</span>
                    </label>
                @empty
                    <p class="text-gray-500 text-sm">No roles available.</p>
                @endforelse
            </div>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ $user->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</x-admin.layouts.admin>
