{{-- Admin Blog Users Index --}}
<x-admin.layouts.admin title="Blog Users">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blog Users</h1>
        <a href="{{ route('admin.blog.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create User
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-3">{{ $user['id'] ?? '—' }}</td>
                        <td>{{ $user['name'] ?? '—' }}</td>
                        <td>{{ $user['email'] ?? '—' }}</td>
                        <td>
                            @forelse($user['roles'] ?? [] as $role)
                                <span class="badge bg-secondary me-1">{{ $role['title'] ?? $role['name'] ?? '' }}</span>
                            @empty
                                <span class="text-muted">—</span>
                            @endforelse
                        </td>
                        <td>
                            @if($user['is_active'] ?? false)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.users.show', $user['id']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.blog.users.edit', $user['id']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin.layouts.admin>
