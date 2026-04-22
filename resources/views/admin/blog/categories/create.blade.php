{{-- Admin Blog Categories Create/Edit --}}
<x-admin.layouts.admin title="{{ $category ? 'Edit Category' : 'Create Category' }}">
    <h1 class="mb-4">{{ $category ? 'Edit Category' : 'Create Category' }}</h1>

    <form method="POST" action="{{ $category ? route('admin.blog.categories.update', $category['id']) : route('admin.blog.categories.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($category) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $category['title'] ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Parent Category</label>
                <select name="parent_id" class="form-select">
                    <option value="">None</option>
                    @foreach($parentCategories as $cat)
                        <option value="{{ $cat['id'] }}" {{ ($category['parent_id'] ?? '') == $cat['id'] ? 'selected' : '' }}>
                            {{ $cat['title'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category['slug'] ?? '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="2" class="form-control">{{ old('description', $category['description'] ?? '') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ ($category['is_active'] ?? true) ? 'checked' : '' }}
                    class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $category ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
