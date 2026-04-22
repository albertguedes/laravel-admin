{{-- Admin Blog Tags Index --}}
<x-admin.layouts.admin title="Blog Tags">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blog Tags</h1>
        <a href="{{ route('admin.blog.tags.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Tag
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                    <tr>
                        <td class="ps-3">{{ $tag['id'] ?? '—' }}</td>
                        <td>{{ $tag['title'] ?? '—' }}</td>
                        <td><code>{{ $tag['slug'] ?? '—' }}</code></td>
                        <td>
                            @if($tag['is_active'] ?? true)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.tags.show', $tag['id']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.blog.tags.edit', $tag['id']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.blog.tags.destroy', $tag['id']) }}" class="d-inline"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">No tags found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin.layouts.admin>
