<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="email@example.com" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
</form>

<style>
.btn-primary {
    background-color: #F9322C;
    border-color: #F9322C;
}
.btn-primary:hover {
    background-color: #d92a24;
    border-color: #d92a24;
}
.btn-primary:focus {
    background-color: #F9322C;
    border-color: #F9322C;
    box-shadow: 0 0 0 3px rgba(249, 50, 44, 0.25);
}
</style>
