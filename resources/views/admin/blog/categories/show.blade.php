{{-- Admin Blog Category Show --}}
<x-admin.layouts.admin title="Category Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Category Details</h1>
        <a href="{{ route('admin.blog.categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($category)
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $category['id'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Title</label>
                <p class="mb-0">{{ $category['title'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Parent</label>
                <p class="mb-0">{{ $category['parent']['title'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Slug</label>
                <p class="mb-0">{{ $category['slug'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Description</label>
                <p class="mb-0">{{ $category['description'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Status</label>
                <p class="mb-0">
                    @if($category['is_active'] ?? true)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.blog.categories.edit', $category['id']) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-secondary">Category not found.</div>
    @endif
</x-admin.layouts.admin>
