{{-- Admin Blog Post Show --}}
<x-admin.layouts.admin title="Post Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Post Details</h1>
        <a href="{{ route('admin.blog.posts.index') }}" class="text-blue-600 hover:text-blue-900">Back</a>
    </div>

    @if($post)
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4"><label class="font-semibold">ID:</label><p>{{ $post['id'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Title:</label><p>{{ $post['title'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Author:</label><p>{{ $post['author']['name'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Category:</label><p>{{ $post['category']['title'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Published:</label>
            <span class="px-2 py-1 text-xs rounded {{ ($post['published'] ?? false) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ($post['published'] ?? false) ? 'Yes' : 'No' }}
            </span>
        </div>
        <div class="mb-4"><label class="font-semibold">Description:</label><p>{{ $post['description'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Content:</label><p class="whitespace-pre-wrap">{{ $post['content'] }}</p></div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.blog.posts.edit', $post['id']) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Edit</a>
        </div>
    </div>
    @else
    <p class="text-gray-500">Post not found.</p>
    @endif
</x-admin.layouts.admin>
