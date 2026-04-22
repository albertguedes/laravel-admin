{{-- Admin Blog Users Create/Edit --}}
<x-admin.layouts.admin title="{{ $user ? 'Edit User' : 'Create User' }}">
    <h1 class="mb-4">{{ $user ? 'Edit User' : 'Create User' }}</h1>

    <form method="POST" action="{{ $user ? route('admin.blog.users.update', $user['id']) : route('admin.blog.users.store') }}"
        class="card">
        <div class="card-body">
            @csrf
            @if($user) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $user['name'] ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user['email'] ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="{{ old('username', $user['username'] ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password {{ $user ? '(leave blank)' : '' }}</label>
                <input type="password" name="password" class="form-control" {{ $user ? '' : 'required' }}>
            </div>

            <div class="mb-3">
                <label class="form-label">About</label>
                <textarea name="about" rows="2" class="form-control">{{ old('about', $user['about'] ?? '') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ ($user['is_active'] ?? true) ? 'checked' : '' }}
                    class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_admin" value="1" {{ ($user['is_admin'] ?? false) ? 'checked' : '' }}
                    class="form-check-input" id="is_admin">
                <label class="form-check-label" for="is_admin">Admin</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $user ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</x-admin.layouts.admin>
