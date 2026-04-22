@php
/**
 * Managed Apps Index View
 *
 * @var \Illuminate\Database\Eloquent\Collection $apps
 * @var string|null $search
 */
@endphp

<x-admin.layouts.admin title="Manage Apps">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Applications</h1>
        <a href="{{ route('admin.apps.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create App
        </a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search apps..."
            class="border rounded px-3 py-2 w-64">
        <button type="submit" class="bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600">Search</button>
        <a href="{{ route('admin.apps.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Clear</a>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">API URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($apps as $app)
                <tr>
                    <td class="px-6 py-4">{{ $app->id }}</td>
                    <td class="px-6 py-4">{{ $app->name }}</td>
                    <td class="px-6 py-4 font-mono text-sm">{{ $app->slug }}</td>
                    <td class="px-6 py-4">{{ $app->api_url }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $app->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $app->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.apps.show', $app) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.apps.edit', $app) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.apps.destroy', $app) }}" class="inline"
                            onsubmit="return confirm('Delete this app?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No apps found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $apps->withQueryString()->links() }}
    </div>
</x-admin.layouts.admin>
