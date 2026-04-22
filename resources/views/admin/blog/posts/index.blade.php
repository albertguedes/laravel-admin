{{-- Admin Blog Posts Index --}}
<x-admin.layouts.admin title="Blog Posts">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blog Posts</h1>
        <a href="{{ route('admin.blog.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create Post
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Published</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($posts as $post)
                <tr>
                    <td class="px-6 py-4">{{ $post['id'] ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $post['title'] ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $post['author']['name'] ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $post['category']['title'] ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ ($post['published'] ?? false) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ($post['published'] ?? false) ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.blog.posts.show', $post['id']) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.blog.posts.edit', $post['id']) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.blog.posts.destroy', $post['id']) }}" class="inline"
                            onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(!empty($meta['last_page']) && $meta['last_page'] > 1)
    <div class="mt-4 flex justify-center">
        @for($i = 1; $i <= $meta['last_page']; $i++)
            <a href="{{ route('admin.blog.posts.index', ['page' => $i]) }}"
                class="px-3 py-1 mx-1 rounded {{ ($meta['current_page'] ?? 1) == $i ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $i }}
            </a>
        @endfor
    </div>
    @endif
</x-admin.layouts.admin>
