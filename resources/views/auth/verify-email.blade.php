<x-layouts.auth>
    <h3 class="card-title text-center mb-3">Verify Email</h3>
    <p class="text-muted text-center mb-4">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
    </p>

    @if(session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-3">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Resend Verification Email</button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-outline-secondary">Log Out</button>
        </div>
    </form>
</x-layouts.auth>
