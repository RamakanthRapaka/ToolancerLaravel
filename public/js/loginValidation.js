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


// 🔐 Password Strength Meter
const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('password-strength-bar');
const strengthText = document.getElementById('password-strength-text');

if (passwordInput) {
    passwordInput.addEventListener('input', function () {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[\W]/.test(password)) strength++;

        strengthBar.className = 'progress-bar';

        if (password.length === 0) {
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
        }
        else if (strength <= 1) {
            strengthBar.style.width = '25%';
            strengthBar.classList.add('weak');
            strengthText.textContent = 'Weak password';
        }
        else if (strength === 2 || strength === 3) {
            strengthBar.style.width = '60%';
            strengthBar.classList.add('medium');
            strengthText.textContent = 'Medium strength';
        }
        else {
            strengthBar.style.width = '100%';
            strengthBar.classList.add('strong');
            strengthText.textContent = 'Strong password';
        }
    });
}

if (passwordInput && passwordInput.value.length > 0) {
    const strong =
        passwordInput.value.length >= 8 &&
        /[A-Z]/.test(passwordInput.value) &&
        /[0-9]/.test(passwordInput.value) &&
        /[\W]/.test(passwordInput.value);

    if (!strong) {
        passwordInput.setCustomValidity('Password is too weak');
    } else {
        passwordInput.setCustomValidity('');
    }
}

// 👁 Show / Hide Password (Font Awesome)
document.querySelectorAll('.password-toggle').forEach(toggle => {
    toggle.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

