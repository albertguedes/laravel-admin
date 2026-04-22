@php
/**
 * User Show View
 *
 * @var \App\Models\User $user
 */
@endphp

<x-admin.layouts.admin title="User Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">User Details</h1>
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-900">Back to List</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4">
            <label class="font-semibold text-gray-700">ID:</label>
            <p class="text-gray-900">{{ $user->id }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Name:</label>
            <p class="text-gray-900">{{ $user->name }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Email:</label>
            <p class="text-gray-900">{{ $user->email }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Status:</label>
            <p class="text-gray-900">
                <span class="px-2 py-1 text-xs rounded {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Roles:</label>
            <div class="mt-1">
                @forelse($user->roles as $role)
                    <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $role->name }}</span>
                @empty
                    <span class="text-gray-400">No roles assigned</span>
                @endforelse
            </div>
        </div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                onsubmit="return confirm('Delete this user?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
</x-admin.layouts.admin>
