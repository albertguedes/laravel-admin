@php
/**
 * Create/Edit User Form View
 *
 * @var \App\Models\User $user
 * @var array $roles
 */
@endphp

<x-admin.layouts.admin title="{{ $user->exists ? 'Edit User' : 'Create User' }}">
    <h1 class="mb-4">{{ $user->exists ? 'Edit User' : 'Create User' }}</h1>

    <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($user->exists) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password {{ $user->exists ? '(leave blank to keep)' : '' }}</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    {{ $user->exists ? '' : 'required' }}>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
                    class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Roles</label>
                <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                    @forelse(\Spatie\Permission\Models\Role::all() as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                {{ in_array($role->name, old('roles', $roles ?? [])) ? 'checked' : '' }}
                                class="form-check-input" id="role_{{ $role->id }}">
                            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No roles available.</p>
                    @endforelse
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ $user->exists ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
