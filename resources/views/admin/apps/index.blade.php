@php
/**
 * Managed Apps Index View
 *
 * @var \Illuminate\Database\Eloquent\Collection $apps
 * @var string|null $search
 */
@endphp

<x-admin.layouts.admin title="Manage Apps">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Applications</h1>
        <a href="{{ route('admin.apps.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create App
        </a>
    </div>

    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search apps..."
                    class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="{{ route('admin.apps.index') }}" class="btn btn-light">Clear</a>
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
                        <th>Slug</th>
                        <th>API URL</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apps as $app)
                    <tr>
                        <td class="ps-3">{{ $app->id }}</td>
                        <td>{{ $app->name }}</td>
                        <td><code>{{ $app->slug }}</code></td>
                        <td>{{ $app->api_url }}</td>
                        <td>
                            @if($app->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.apps.show', $app) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.apps.edit', $app) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.apps.destroy', $app) }}" class="d-inline"
                                onsubmit="return confirm('Delete this app?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No apps found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $apps->withQueryString()->links() }}
    </div>
</x-admin.layouts.admin>
