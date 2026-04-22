{{-- Admin Blog Categories Index --}}
<x-admin.layouts.admin title="Blog Categories">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blog Categories</h1>
        <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Category
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td class="ps-3">{{ $cat['id'] ?? '—' }}</td>
                        <td>{{ $cat['title'] ?? '—' }}</td>
                        <td>{{ $cat['parent']['title'] ?? '—' }}</td>
                        <td>
                            @if($cat['is_active'] ?? true)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.categories.show', $cat['id']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.blog.categories.edit', $cat['id']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.blog.categories.destroy', $cat['id']) }}" class="d-inline"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin.layouts.admin>
