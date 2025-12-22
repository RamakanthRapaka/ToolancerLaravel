// public/js/form-helpers.js

window.resetPasswordStrength = function (form) {
    if (!form) return;

    const strengthBar = form.querySelector('.password-strength-bar');
    const strengthText = form.querySelector('.password-strength-text');
    const passwordInput = form.querySelector('input[name="password"]');

    if (!strengthBar || !strengthText) return;

    strengthBar.style.width = '0%';
    strengthBar.className = 'password-strength-bar progress-bar';
    strengthText.textContent = '';

    // Clear validation message if any
    if (passwordInput) {
        passwordInput.setCustomValidity('');
    }
};

window.resetSelectPickers = function (form) {
    if (!form) return;

    const selects = form.querySelectorAll('.selectpicker');

    selects.forEach(select => {

        // 🔥 Destroy existing instance (prevents duplicates)
        if ($(select).data('selectpicker')) {
            $(select).selectpicker('destroy');
        }

        // Clear all selected options
        Array.from(select.options).forEach(option => {
            option.selected = false;
        });

        // Re-initialize ONCE
        $(select).selectpicker();

        // Remove validation UI
        $(select)
            .closest('.bootstrap-select')
            .removeClass('is-invalid');
    });
};

window.clearServerErrors = function (form) {
    if (!form) return;

    // Remove invalid state
    form.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });

    // Hide error messages
    form.querySelectorAll('.invalid-feedback').forEach(el => {
        el.innerText = '';
        el.style.display = 'none';
    });

    // Remove bootstrap validation class
    form.classList.remove('was-validated');
};
