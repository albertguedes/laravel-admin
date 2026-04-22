{{-- Admin Blog Posts Create/Edit --}}
<x-admin.layouts.admin title="{{ $post ? 'Edit Post' : 'Create Post' }}">
    <h1 class="mb-4">{{ $post ? 'Edit Post' : 'Create Post' }}</h1>

    <form method="POST" action="{{ $post ? route('admin.blog.posts.update', $post['id']) : route('admin.blog.posts.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($post) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $post['title'] ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Author</label>
                <select name="author_id" class="form-select" required>
                    <option value="">Select Author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author['id'] }}" {{ ($post['author_id'] ?? '') == $author['id'] ? 'selected' : '' }}>
                            {{ $author['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat['id'] }}" {{ ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : '' }}>
                            {{ $cat['title'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $post['slug'] ?? '') }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="2" class="form-control" required>{{ old('description', $post['description'] ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content', $post['content'] ?? '') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="published" value="1" {{ ($post['published'] ?? true) ? 'checked' : '' }}
                    class="form-check-input" id="published">
                <label class="form-check-label" for="published">Published</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ $post ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
