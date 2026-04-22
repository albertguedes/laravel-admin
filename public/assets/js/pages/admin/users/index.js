/**
 * Admin Users Index Page JavaScript
 *
 * @author Albert R. C. Guedes
 * @description Interactive behaviors for admin users management page.
 * @path /admin/users
 */

/**
 * Confirm before deleting a user
 * @returns {boolean}
 */
function confirmDeleteUser() {
    return confirm('Are you sure you want to delete this user?');
}
