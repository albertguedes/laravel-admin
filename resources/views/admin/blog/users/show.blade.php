{{-- Admin Blog User Show --}}
<x-admin.layouts.admin title="User Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">User Details</h1>
        <a href="{{ route('admin.blog.users.index') }}" class="text-blue-600 hover:text-blue-900">Back</a>
    </div>

    @if($user)
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4"><label class="font-semibold">ID:</label><p>{{ $user['id'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Name:</label><p>{{ $user['name'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Email:</label><p>{{ $user['email'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Username:</label><p>{{ $user['username'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">About:</label><p>{{ $user['about'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Roles:</label>
            @forelse($user['roles'] ?? [] as $role)
                <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $role['title'] ?? $role['name'] ?? '' }}</span>
            @empty
                <span class="text-gray-400">—</span>
            @endforelse
        </div>
        <div class="mb-4"><label class="font-semibold">Admin:</label>
            <span class="px-2 py-1 text-xs rounded {{ ($user['is_admin'] ?? false) ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                {{ ($user['is_admin'] ?? false) ? 'Yes' : 'No' }}
            </span>
        </div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.blog.users.edit', $user['id']) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Edit</a>
        </div>
    </div>
    @else
    <p class="text-gray-500">User not found.</p>
    @endif
</x-admin.layouts.admin>
