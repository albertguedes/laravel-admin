{{-- Admin Blog Category Show --}}
<x-admin.layouts.admin title="Category Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Category Details</h1>
        <a href="{{ route('admin.blog.categories.index') }}" class="text-blue-600 hover:text-blue-900">Back</a>
    </div>

    @if($category)
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4"><label class="font-semibold">ID:</label><p>{{ $category['id'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Title:</label><p>{{ $category['title'] }}</p></div>
        <div class="mb-4"><label class="font-semibold">Parent:</label><p>{{ $category['parent']['title'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Slug:</label><p>{{ $category['slug'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Description:</label><p>{{ $category['description'] ?? '—' }}</p></div>
        <div class="mb-4"><label class="font-semibold">Status:</label>
            <span class="px-2 py-1 text-xs rounded {{ ($category['is_active'] ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ($category['is_active'] ?? true) ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.blog.categories.edit', $category['id']) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Edit</a>
        </div>
    </div>
    @else
    <p class="text-gray-500">Category not found.</p>
    @endif
</x-admin.layouts.admin>
