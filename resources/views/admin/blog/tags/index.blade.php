{{-- Admin Blog Tags Index --}}
<x-admin.layouts.admin title="Blog Tags">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blog Tags</h1>
        <a href="{{ route('admin.blog.tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create Tag
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tags as $tag)
                <tr>
                    <td class="px-6 py-4">{{ $tag['id'] ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $tag['title'] ?? '—' }}</td>
                    <td class="px-6 py-4 font-mono text-sm">{{ $tag['slug'] ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ ($tag['is_active'] ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ($tag['is_active'] ?? true) ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.blog.tags.show', $tag['id']) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.blog.tags.edit', $tag['id']) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.blog.tags.destroy', $tag['id']) }}" class="inline"
                            onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No tags found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin.layouts.admin>
