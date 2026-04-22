@php
/**
 * User Show View
 *
 * @var \App\Models\User $user
 */
@endphp

<x-admin.layouts.admin title="User Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">User Details</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $user->id }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Name</label>
                <p class="mb-0">{{ $user->name }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Email</label>
                <p class="mb-0">{{ $user->email }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Status</label>
                <p class="mb-0">
                    @if($user->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Roles</label>
                <p class="mb-0">
                    @forelse($user->roles as $role)
                        <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                    @empty
                        <span class="text-muted">No roles assigned</span>
                    @endforelse
                </p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                    onsubmit="return confirm('Delete this user?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layouts.admin>
