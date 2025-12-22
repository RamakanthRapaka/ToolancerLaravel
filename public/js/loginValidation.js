(() => {
    'use strict';

    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {

            let isValid = form.checkValidity();

            // 🔥 Manual validation for bootstrap-select
            const selects = form.querySelectorAll('.selectpicker');

            selects.forEach(select => {
                const bsSelect = $(select).closest('.bootstrap-select');

                if (!select.selectedOptions || select.selectedOptions.length === 0) {
                    isValid = false;
                    bsSelect.addClass('is-invalid');
                } else {
                    bsSelect.removeClass('is-invalid');
                }
            });

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });

    // 🔄 Clear select error immediately on change
    $('.selectpicker').on('changed.bs.select', function () {
        const bsSelect = $(this).closest('.bootstrap-select');
        bsSelect.removeClass('is-invalid');
    });

})();

// 🔐 Password Strength Meter (supports multiple forms)
document.querySelectorAll('.needs-validation').forEach(form => {

    const passwordInput = form.querySelector('input[name="password"]');
    const strengthBar = form.querySelector('.password-strength-bar');
    const strengthText = form.querySelector('.password-strength-text');

    if (!passwordInput || !strengthBar || !strengthText) return;

    passwordInput.addEventListener('input', function () {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[\W]/.test(password)) strength++;

        strengthBar.className = 'password-strength-bar progress-bar';

        if (password.length === 0) {
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
            passwordInput.setCustomValidity('');
        }
        else if (strength <= 1) {
            strengthBar.style.width = '25%';
            strengthBar.classList.add('weak');
            strengthText.textContent = 'Weak password';
            passwordInput.setCustomValidity('Password is too weak');
        }
        else if (strength <= 3) {
            strengthBar.style.width = '60%';
            strengthBar.classList.add('medium');
            strengthText.textContent = 'Medium strength';
            passwordInput.setCustomValidity('');
        }
        else {
            strengthBar.style.width = '100%';
            strengthBar.classList.add('strong');
            strengthText.textContent = 'Strong password';
            passwordInput.setCustomValidity('');
        }
    });
});

// 👁 Show / Hide Password (Font Awesome)
document.addEventListener('click', function (e) {
    const toggle = e.target.closest('.password-toggle');
    if (!toggle) return;

    const targetId = toggle.getAttribute('data-target');
    const input = document.getElementById(targetId);
    if (!input) return;

    const icon = toggle.querySelector('i');

    // Toggle type
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';

    // Toggle icon
    icon.classList.toggle('fa-eye', !isPassword);
    icon.classList.toggle('fa-eye-slash', isPassword);

    // 🔥 IMPORTANT: remove validation background again
    input.style.backgroundImage = 'none';
    input.style.backgroundRepeat = 'no-repeat';

    // Force Bootstrap variables again
    input.style.setProperty('--bs-form-valid-bg-icon', 'none');
    input.style.setProperty('--bs-form-invalid-bg-icon', 'none');
});


