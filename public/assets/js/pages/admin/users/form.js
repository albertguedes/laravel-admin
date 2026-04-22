/**
 * Admin Users Form Page JavaScript
 *
 * @author Albert R. C. Guedes
 * @description Interactive behaviors for admin user create/edit page.
 * @path /admin/users/create, /admin/users/{id}/edit
 */

/**
 * Form validation before submit
 * @param {HTMLFormElement} form
 * @returns {boolean}
 */
function validateUserForm(form) {
    const email = form.querySelector('[name="email"]').value;
    const name = form.querySelector('[name="name"]').value;

    if (!email || !name) {
        alert('Please fill in all required fields.');
        return false;
    }

    return true;
}
