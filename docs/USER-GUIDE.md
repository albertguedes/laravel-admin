# User Guide

## Login

1. Visit `/login`
2. Use admin credentials (seeded on first setup):
   - Email: `admin@admin.com`
   - Password: `password`

## Admin Management

### Users

- **List**: `/admin/users` - View all admin users
- **Create**: `/admin/users/create` - New admin user
- **Edit**: `/admin/users/{id}/edit` - Update user
- **Delete**: Use delete button on list or edit page

### Roles

- **List**: `/admin/roles` - View all roles
- **Create**: `/admin/roles/create` - New role with permissions
- **Edit**: `/admin/roles/{id}/edit` - Update role

### Managed Apps

- **List**: `/admin/apps` - View connected applications
- **Create**: `/admin/apps/create` - Connect new app via API

## Blog Management

Access via `/admin/blog/*`:
- **Posts**: `/admin/blog/posts` - Manage blog posts
- **Categories**: `/admin/blog/categories` - Manage categories
- **Tags**: `/admin/blog/tags` - Manage tags
- **Users**: `/admin/blog/users` - Manage blog users

All blog operations use the Blog API (`/api/admin/*` endpoints).
