# AGENTS.md

## Laravel Admin Project

Generic admin panel to manage portfolio Laravel applications via API. Uses Breeze + Sanctum for auth, Spatie for roles/permissions.

## Commands

```bash
php artisan serve              # Dev server
php artisan migrate           # Run migrations
php artisan migrate:fresh     # Rebuild database
php artisan db:seed --class=AdminUserSeeder  # Seed admin user

./vendor/bin/pest              # All tests
./vendor/bin/pest --testsuite=Unit  # Unit only
./vendor/bin/pest --filter=TestName # Single test

./vendor/bin/pint --test       # Dry-run lint
./vendor/bin/pint             # Apply fixes
```

## Testing

- Pest (PHPUnit wrapper) - config in `phpunit.xml`
- Test database: SQLite in-memory
- Feature tests: `tests/Feature/Admin/`, `tests/Feature/Blog/`
- Unit tests: `tests/Unit/Services/`

## Key Paths

- Routes: `routes/web.php`
- Admin controllers: `app/Http/Controllers/Admin/`
- Blog controllers: `app/Http/Controllers/Blog/`
- Services: `app/Services/BlogApiService.php`
- Views: `resources/views/admin/`
- Docs: `docs/`

## Config

- `config/admin.php` - BLOG_API_URL, BLOG_API_TOKEN
- Style: Pint with Laravel preset
- Frontend: Plain CSS/JS in `public/assets/`
