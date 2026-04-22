{{-- Admin Blog Tag Show --}}
<x-admin.layouts.admin title="Tag Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Tag Details</h1>
        <a href="{{ route('admin.blog.tags.index') }}" class="text-blue-600 hover:text-blue-900">Back</a>
    </div>

    @if($tag)
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4"><label class="font-semibold">ID:</label><p>{{ $tag['id'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Title:</label><p>{{ $tag['title'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Slug:</label><p class="font-mono">{{ $tag['slug'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Description:</label><p>{{ $tag['description'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Posts Count:</label><p>{{ $tag['posts_count'] ?? 0 }}</p></div>
        <div class="mb-4"><label class="font-semibold">Status:</label>
            <span class="px-2 py-1 text-xs rounded {{ ($tag['is_active'] ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ($tag['is_active'] ?? true) ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.blog.tags.edit', $tag['id']) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Edit</a>
        </div>
    </div>
    @else
    <p class="text-gray-500">Tag not found.</p>
    @endif
</x-admin.layouts.admin>
