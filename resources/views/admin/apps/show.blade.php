@php
/**
 * App Show View
 *
 * @var \App\Models\ManagedApp $app
 */
@endphp

<x-admin.layouts.admin title="App Details">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">App Details</h1>
        <a href="{{ route('admin.apps.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">ID</label>
                <p class="mb-0">{{ $app->id }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Name</label>
                <p class="mb-0">{{ $app->name }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Slug</label>
                <p class="mb-0"><code>{{ $app->slug }}</code></p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">API URL</label>
                <p class="mb-0">{{ $app->api_url }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">API Token</label>
                <p class="mb-0"><code>{{ $app->api_token ?? '—' }}</code></p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Status</label>
                <p class="mb-0">
                    @if($app->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </p>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-muted small text-uppercase">Admins</label>
                <p class="mb-0">
                    @forelse($app->admins as $admin)
                        <span class="badge bg-secondary me-1">{{ $admin->name }}</span>
                    @empty
                        <span class="text-muted">No admins assigned</span>
                    @endforelse
                </p>
            </div>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.apps.edit', $app) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.apps.destroy', $app) }}"
                    onsubmit="return confirm('Delete this app?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layouts.admin>
