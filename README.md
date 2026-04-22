# Laravel Admin

Generic admin panel to manage portfolio Laravel applications via API.

## Features

- **Authentication**: Login-only admin system (Breeze + Sanctum)
- **User Management**: Admin users with roles and permissions (Spatie)
- **Multi-App Management**: Connect and manage multiple applications via API
- **Blog Integration**: Full CRUD for posts, categories, tags, users via Blog API
- **Modular Architecture**: Services layer for API communication

## Tech Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Auth**: Laravel Sanctum (API tokens), Breeze (session)
- **Permissions**: Spatie Laravel Permission
- **Frontend**: Blade templates, Tailwind CSS, Alpine.js
- **Testing**: Pest (PHPUnit wrapper)

## Quick Start

```bash
git clone git@github.com:albertguedes/laravel-admin.git
cd laravel-admin
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
php artisan serve
```

**Login**: `admin@admin.com` / `password`

## Architecture

```
Admin Panel → API Client → Managed Apps (Blog)
     ↓
  Users, Roles, Apps Management
     ↓
  Blog Posts, Categories, Tags, Users (via API)
```

## Documentation

- [Developer Guide](docs/DEVELOPER-GUIDE.md)
- [Architecture](docs/ARCHITECTURE.md)
- [User Guide](docs/USER-GUIDE.md)

## License

MIT
