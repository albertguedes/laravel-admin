{{-- Admin Blog Users Index --}}
<x-admin.layouts.admin title="Blog Users">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blog Users</h1>
        <a href="{{ route('admin.blog.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create User
        </a>
    </div>

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
                    <td class="px-6 py-4">{{ $user['id'] ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $user['name'] ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $user['email'] ?? '—' }}</td>
                    <td class="px-6 py-4">
                        @forelse($user['roles'] ?? [] as $role)
                            <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $role['title'] ?? $role['name'] ?? '' }}</span>
                        @empty
                            <span class="text-gray-400">—</span>
                        @endforelse
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ ($user['is_active'] ?? false) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ($user['is_active'] ?? false) ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.blog.users.show', $user['id']) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.blog.users.edit', $user['id']) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin.layouts.admin>
