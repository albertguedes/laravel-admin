# Developer Guide

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
```

## Configuration (.env)

```env
BLOG_API_URL=http://localhost:8000/api
BLOG_API_TOKEN=your-blog-sanctum-token
```

## Commands

```bash
php artisan serve                    # Dev server
php artisan migrate                 # Run migrations
php artisan migrate:fresh           # Rebuild database
./vendor/bin/pest                   # Run tests
./vendor/bin/pint                   # Style fix
```

## Key Paths

- Routes: `routes/web.php`
- Controllers: `app/Http/Controllers/Admin/`, `app/Http/Controllers/Blog/`
- Services: `app/Services/BlogApiService.php`
- Views: `resources/views/admin/`
- Assets: `public/assets/css/`, `public/assets/js/`

## Testing

Tests use SQLite in-memory (`phpunit.xml`). Run:
```bash
./vendor/bin/pest                    # All tests
./vendor/bin/pest --testsuite=Unit  # Unit only
```
