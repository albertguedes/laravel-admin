{{-- Admin Blog Tags Create/Edit --}}
<x-admin.layouts.admin title="{{ $tag ? 'Edit Tag' : 'Create Tag' }}">
    <h1 class="text-2xl font-bold mb-6">{{ $tag ? 'Edit Tag' : 'Create Tag' }}</h1>

    <form method="POST" action="{{ $tag ? route('admin.blog.tags.update', $tag['id']) : route('admin.blog.tags.store') }}"
        class="bg-white p-6 rounded-lg shadow max-w-lg">
        @csrf
        @if($tag) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ old('title', $tag['title'] ?? '') }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $tag['slug'] ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="2" class="w-full border rounded px-3 py-2">{{ old('description', $tag['description'] ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ ($tag['is_active'] ?? true) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm">Active</span>
            </label>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ $tag ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.blog.tags.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</x-admin.layouts.admin>
