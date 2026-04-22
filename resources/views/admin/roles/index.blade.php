@php
/**
 * Roles Index View
 *
 * @var \Illuminate\Database\Eloquent\Collection $roles
 * @var string|null $search
 */
@endphp

<x-admin.layouts.admin title="Manage Roles">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Roles</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Role
        </a>
    </div>

    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search roles..."
                    class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-light">Clear</a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td class="ps-3">{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description ?? '—' }}</td>
                        <td>
                            @forelse($role->permissions->take(3) as $perm)
                                <span class="badge bg-secondary me-1">{{ $perm->name }}</span>
                            @empty
                                <span class="text-muted">No permissions</span>
                            @endforelse
                            @if($role->permissions->count() > 3)
                                <span class="text-muted">+{{ $role->permissions->count() - 3 }} more</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="d-inline"
                                onsubmit="return confirm('Delete this role?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No roles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $roles->withQueryString()->links() }}
    </div>
</x-admin.layouts.admin>
