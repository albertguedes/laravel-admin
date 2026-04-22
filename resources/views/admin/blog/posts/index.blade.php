{{-- Admin Blog Posts Index --}}
<x-admin.layouts.admin title="Blog Posts">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blog Posts</h1>
        <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Post
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="ps-3">{{ $post['id'] ?? '—' }}</td>
                        <td>{{ $post['title'] ?? '—' }}</td>
                        <td>{{ $post['author']['name'] ?? '—' }}</td>
                        <td>{{ $post['category']['title'] ?? '—' }}</td>
                        <td>
                            @if($post['published'] ?? false)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.posts.show', $post['id']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.blog.posts.edit', $post['id']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.blog.posts.destroy', $post['id']) }}" class="d-inline"
                                onsubmit="return confirm('Delete this post?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No posts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(!empty($meta['last_page']) && $meta['last_page'] > 1)
    <div class="mt-4 d-flex justify-content-center gap-1 flex-wrap">
        @for($i = 1; $i <= $meta['last_page']; $i++)
            <a href="{{ route('admin.blog.posts.index', ['page' => $i]) }}"
                class="btn btn-sm {{ ($meta['current_page'] ?? 1) == $i ? 'btn-primary' : 'btn-outline-secondary' }}">
                {{ $i }}
            </a>
        @endfor
    </div>
    @endif
</x-admin.layouts.admin>
