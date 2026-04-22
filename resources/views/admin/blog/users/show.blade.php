{{-- Admin Blog User Show --}}
<x-admin.layouts.admin title="User Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">User Details</h1>
        <a href="{{ route('admin.blog.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($user)
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $user['id'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Name</label>
                <p class="mb-0">{{ $user['name'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Email</label>
                <p class="mb-0">{{ $user['email'] }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Username</label>
                <p class="mb-0">{{ $user['username'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">About</label>
                <p class="mb-0">{{ $user['about'] ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Roles</label>
                <p class="mb-0">
                    @forelse($user['roles'] ?? [] as $role)
                        <span class="badge bg-secondary me-1">{{ $role['title'] ?? $role['name'] ?? '' }}</span>
                    @empty
                        <span class="text-muted">—</span>
                    @endforelse
                </p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Admin</label>
                <p class="mb-0">
                    @if($user['is_admin'] ?? false)
                        <span class="badge bg-warning">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.blog.users.edit', $user['id']) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-secondary">User not found.</div>
    @endif
</x-admin.layouts.admin>
