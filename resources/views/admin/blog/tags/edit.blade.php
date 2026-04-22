{{-- Admin Blog Tags Create/Edit --}}
<x-admin.layouts.admin title="{{ $tag ? 'Edit Tag' : 'Create Tag' }}">
    <h1 class="mb-4">{{ $tag ? 'Edit Tag' : 'Create Tag' }}</h1>

    <form method="POST" action="{{ $tag ? route('admin.blog.tags.update', $tag['id']) : route('admin.blog.tags.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($tag) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $tag['title'] ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $tag['slug'] ?? '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="2" class="form-control">{{ old('description', $tag['description'] ?? '') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ ($tag['is_active'] ?? true) ? 'checked' : '' }}
                    class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $tag ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog.tags.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
