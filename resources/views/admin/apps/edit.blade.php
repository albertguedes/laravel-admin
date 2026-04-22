@php
/**
 * Create/Edit App Form View
 *
 * @var \App\Models\ManagedApp $app
 */
@endphp

<x-admin.layouts.admin title="{{ $app->exists ? 'Edit App' : 'Create App' }}">
    <h1 class="mb-4">{{ $app->exists ? 'Edit App' : 'Create App' }}</h1>

    <form method="POST" action="{{ $app->exists ? route('admin.apps.update', $app) : route('admin.apps.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($app->exists) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $app->name) }}"
                    class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $app->slug) }}"
                    class="form-control @error('slug') is-invalid @enderror" required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">API URL</label>
                <input type="url" name="api_url" value="{{ old('api_url', $app->api_url) }}"
                    placeholder="https://blog.example.com/api"
                    class="form-control @error('api_url') is-invalid @enderror" required>
                @error('api_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">API Token</label>
                <input type="text" name="api_token" value="{{ old('api_token', $app->api_token) }}"
                    placeholder="{{ $app->exists ? '(leave blank to keep current)' : '(auto-generated if empty)' }}"
                    class="form-control @error('api_token') is-invalid @enderror">
                @error('api_token')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($app->exists && $app->api_token)
                    <div class="form-text">Leave blank to keep current token.</div>
                @endif
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $app->is_active ?? true) ? 'checked' : '' }}
                    class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ $app->exists ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route('admin.apps.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
