@php
/**
 * Admin Layout
 * Main layout wrapper for all admin pages.
 *
 * @author Albert R. C. Guedes
 * @copyright 2026
 *
 * @var string $title Page title
 * @var \Illuminate\View\ComponentSlot|null $slot Content slot
 */
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - Laravel Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">Admin Panel</a>
            <div class="navbar-menu">
                <a href="{{ route('admin.dashboard') }}" class="navbar-link">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="navbar-link">Users</a>
                <a href="{{ route('admin.roles.index') }}" class="navbar-link">Roles</a>
                <a href="{{ route('admin.apps.index') }}" class="navbar-link">Apps</a>
                <a href="{{ route('admin.blog.posts.index') }}" class="navbar-link">Blog</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="navbar-link">Logout</button>
            </form>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>
