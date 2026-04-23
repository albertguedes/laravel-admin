<x-layouts.auth>
    <h3 class="card-title text-center mb-3">Confirm Password</h3>
    <p class="text-muted text-center mb-4">
        This is a secure area of the application. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>
</x-layouts.auth>
