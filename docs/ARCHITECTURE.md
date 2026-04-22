# Architecture

## Overview

Laravel Admin panel for managing portfolio applications via API. Uses Breeze + Sanctum for auth, Spatie for roles/permissions.

## Request Lifecycle

```
Request → Middleware (auth, verified) → Controller → Service → API Client → External App
                                                                    ↓
                                                              BlogApiService
                                                              (HTTP + Sanctum)
```

## Service Layer

| Service | Purpose |
|---------|---------|
| `BlogApiService` | API client for managed apps (blog) |

## Models

- `User` - Admin users with roles (Spatie), soft deletes
- `ManagedApp` - Applications being managed
- `Role`, `Permission` - Spatie permission tables

## Key Paths

```
app/Http/Controllers/Admin/   # Admin CRUD (users, roles, apps)
app/Http/Controllers/Blog/   # Blog management via API
app/Services/BlogApiService.php
routes/web.php               # Admin routes
config/admin.php             # App config (API URL/token)
```
