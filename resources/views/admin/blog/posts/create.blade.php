{{-- Admin Blog Posts Create/Edit --}}
<x-admin.layouts.admin title="{{ $post ? 'Edit Post' : 'Create Post' }}">
    <h1 class="text-2xl font-bold mb-6">{{ $post ? 'Edit Post' : 'Create Post' }}</h1>

    <form method="POST" action="{{ $post ? route('admin.blog.posts.update', $post['id']) : route('admin.blog.posts.store') }}"
        class="bg-white p-6 rounded-lg shadow max-w-2xl">
        @csrf
        @if($post) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ old('title', $post['title'] ?? '') }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Author</label>
            <select name="author_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author['id'] }}" {{ ($post['author_id'] ?? '') == $author['id'] ? 'selected' : '' }}>
                        {{ $author['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat['id'] }}" {{ ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : '' }}>
                        {{ $cat['title'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post['slug'] ?? '') }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="2" class="w-full border rounded px-3 py-2" required>{{ old('description', $post['description'] ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
            <textarea name="content" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('content', $post['content'] ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" {{ ($post['published'] ?? true) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm">Published</span>
            </label>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ $post ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.blog.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</x-admin.layouts.admin>
