{{-- Admin Blog Post Show --}}
<x-admin.layouts.admin title="Post Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Post Details</h1>
        <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($post)
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $post['id'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Title</label>
                <p class="mb-0">{{ $post['title'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Author</label>
                <p class="mb-0">{{ $post['author']['name'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Category</label>
                <p class="mb-0">{{ $post['category']['title'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Published</label>
                <p class="mb-0">
                    @if($post['published'] ?? false)
                        <span class="badge bg-success">Yes</span>
                    @else
                        <span class="badge bg-danger">No</span>
                    @endif
                </p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Description</label>
                <p class="mb-0">{{ $post['description'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Content</label>
                <p class="mb-0" style="white-space: pre-wrap;">{{ $post['content'] }}</p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.blog.posts.edit', $post['id']) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-secondary">Post not found.</div>
    @endif
</x-admin.layouts.admin>
