@php
/**
 * Create/Edit Role Form View
 *
 * @var \Spatie\Permission\Models\Role $role
 * @var array $permissions
 */
@endphp

<x-admin.layouts.admin title="{{ $role->exists ? 'Edit Role' : 'Create Role' }}">
    <h1 class="mb-4">{{ $role->exists ? 'Edit Role' : 'Create Role' }}</h1>

    <form method="POST" action="{{ $role->exists ? route('admin.roles.update', $role) : route('admin.roles.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($role->exists) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}"
                    class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $role->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Permissions</label>
                <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                    @forelse(\Spatie\Permission\Models\Permission::all() as $perm)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                {{ in_array($perm->name, old('permissions', $permissions ?? [])) ? 'checked' : '' }}
                                class="form-check-input" id="perm_{{ $perm->id }}">
                            <label class="form-check-label" for="perm_{{ $perm->id }}">{{ $perm->name }}</label>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No permissions available.</p>
                    @endforelse
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ $role->exists ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
