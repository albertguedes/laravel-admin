<x-layouts.auth>
    <h3 class="card-title text-center mb-3">Forgot Password</h3>
    <p class="text-muted text-center mb-4">
        No problem. Just let us know your email address and we will email you a password reset link.
    </p>

    @if(session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
        </div>
    </form>
</x-layouts.auth>
