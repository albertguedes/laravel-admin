{{-- Admin Blog Tag Show --}}
<x-admin.layouts.admin title="Tag Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Tag Details</h1>
        <a href="{{ route('admin.blog.tags.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($tag)
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $tag['id'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Title</label>
                <p class="mb-0">{{ $tag['title'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Slug</label>
                <p class="mb-0"><code>{{ $tag['slug'] }}</code></p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Description</label>
                <p class="mb-0">{{ $tag['description'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Posts Count</label>
                <p class="mb-0">{{ $tag['posts_count'] ?? 0 }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Status</label>
                <p class="mb-0">
                    @if($tag['is_active'] ?? true)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.blog.tags.edit', $tag['id']) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-secondary">Tag not found.</div>
    @endif
</x-admin.layouts.admin>
