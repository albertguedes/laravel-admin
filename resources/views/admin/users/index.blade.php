@php
/**
 * Users Index View
 *
 * @var \Illuminate\Database\Eloquent\Collection $users
 * @var string|null $search
 */
@endphp

<x-admin.layouts.admin title="Manage Users">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Users</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create User
        </a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search users..."
            class="border rounded px-3 py-2 w-64">
        <button type="submit" class="bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600">Search</button>
        <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Clear</a>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Roles</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr>
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @forelse($user->roles as $role)
                            <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $role->name }}</span>
                        @empty
                            <span class="text-gray-400">No roles</span>
                        @endforelse
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline"
                            onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->withQueryString()->links() }}
    </div>
</x-admin.layouts.admin>
