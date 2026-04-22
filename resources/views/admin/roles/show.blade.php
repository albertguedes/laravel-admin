@php
/**
 * Role Show View
 *
 * @var \Spatie\Permission\Models\Role $role
 */
@endphp

<x-admin.layouts.admin title="Role Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Role Details</h1>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $role->id }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Name</label>
                <p class="mb-0">{{ $role->name }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Description</label>
                <p class="mb-0">{{ $role->description ?? '—' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Permissions</label>
                <p class="mb-0">
                    @forelse($role->permissions as $perm)
                        <span class="badge bg-secondary me-1 mb-1">{{ $perm->name }}</span>
                    @empty
                        <span class="text-muted">No permissions assigned</span>
                    @endforelse
                </p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                    onsubmit="return confirm('Delete this role?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layouts.admin>
