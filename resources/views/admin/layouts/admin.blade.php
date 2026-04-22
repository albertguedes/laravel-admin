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

    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="admin-body-bg">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #232323;">
        <div class="container-fluid">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                <i class="fas fa-cog"></i> Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" class="nav-link">
                            <i class="fas fa-user-shield"></i> Roles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.apps.index') }}" class="nav-link">
                            <i class="fas fa-rocket"></i> Apps
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-blog"></i> Blog
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.blog.posts.index') }}">
                                <i class="fas fa-file-alt"></i> Posts
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.blog.categories.index') }}">
                                <i class="fas fa-folder"></i> Categories
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.blog.tags.index') }}">
                                <i class="fas fa-tags"></i> Tags
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.blog.users.index') }}">
                                <i class="fas fa-user"></i> Users
                            </a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        {{ $slot }}
    </main>

    <footer class="bg-white border-top py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center text-muted">
                    <small>Laravel Admin Panel &copy; 2026</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
