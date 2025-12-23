document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.ajax-form').forEach(form => {

        /**
         * 🔹 Clear validation error on input/change
         */
        form.querySelectorAll('input, select, textarea').forEach(el => {
            ['input', 'change'].forEach(evt => {
                el.addEventListener(evt, function () {
                    this.classList.remove('is-invalid');

                    const feedback = this.closest('.form-group')
                        ?.querySelector('.invalid-feedback');

                    if (feedback) {
                        feedback.innerText = '';
                        feedback.style.display = 'none';
                    }
                });
            });
        });

        /**
         * ✅ PASSWORD MATCH LOGIC (FORM-SCOPED)
         */
        const password = form.querySelector('input[name="password"]');
        const confirmPassword = form.querySelector('input[name="password_confirmation"]');

        if (password && confirmPassword) {
            confirmPassword.addEventListener('input', () => {

                if (confirmPassword.value === '') {
                    confirmPassword.classList.remove('is-invalid');
                    return;
                }

                if (password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');

                    const feedback = confirmPassword.closest('.form-group')
                        ?.querySelector('.invalid-feedback');

                    if (feedback) {
                        feedback.innerText = 'Passwords do not match';
                        feedback.style.display = 'block';
                    }
                } else {
                    confirmPassword.classList.remove('is-invalid');

                    const feedback = confirmPassword.closest('.form-group')
                        ?.querySelector('.invalid-feedback');

                    if (feedback) {
                        feedback.innerText = '';
                        feedback.style.display = 'none';
                    }
                }
            });
        }

        /**
         * 🔹 Submit handler
         */
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';

            /**
             * ❌ HARD STOP if passwords don’t match
             */
            if (password && confirmPassword && password.value !== confirmPassword.value) {

                confirmPassword.classList.add('is-invalid');

                const feedback = confirmPassword.closest('.form-group')
                    ?.querySelector('.invalid-feedback');

                if (feedback) {
                    feedback.innerText = 'Passwords do not match';
                    feedback.style.display = 'block';
                }

                confirmPassword.focus();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                return;
            }

            const formData = new FormData(form);

            /**
             * 🔹 Drawer message container (inside form)
             */
            const messageBox = form.querySelector('.drawer-message');
            if (messageBox) {
                messageBox.style.display = 'none';
                messageBox.innerHTML = '';
            }

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(async res => {
                    if (res.status === 422) {
                        throw await res.json();
                    }
                    if (!res.ok) {
                        throw { message: 'Something went wrong. Please try again.' };
                    }
                    return res.json();
                })
                .then(data => {

                    // ✅ Show success message at bottom of drawer
                    if (messageBox) {
                        messageBox.className = 'drawer-message alert alert-success mt-3';
                        messageBox.innerText = data.message || 'Registration successful';
                        messageBox.style.display = 'block';
                    }

                    form.reset();
                    form.classList.remove('was-validated');

                    // Optional helpers (if exist)
                    if (typeof resetPasswordStrength === 'function') {
                        resetPasswordStrength(form);
                    }
                    if (typeof resetSelectPickers === 'function') {
                        resetSelectPickers(form);
                    }

                    // 🔹 Close drawer after delay
                    setTimeout(() => {
                        const offcanvasEl = document.getElementById('loginslide');
                        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                        offcanvas?.hide();

                        if (messageBox) messageBox.style.display = 'none';
                    }, 2500);
                })
                .catch(err => {

                    if (err.errors) {
                        showErrors(form, err.errors);
                    } else if (messageBox) {
                        messageBox.className = 'drawer-message alert alert-danger mt-3';
                        messageBox.innerText = err.message || 'Something went wrong';
                        messageBox.style.display = 'block';
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
        });
    });

    /**
     * 🔹 Map Laravel validation errors
     */
    function showErrors(form, errors) {

        form.classList.remove('was-validated');

        form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
        });

        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.innerText = '';
            el.style.display = 'none';
        });

        let firstInvalidField = null;

        Object.keys(errors).forEach(field => {

            let input =
                form.querySelector(`[name="${field}"]`) ||
                form.querySelector(`[name="${field}[]"]`);

            if (!input) return;

            input.classList.add('is-invalid');

            if (!firstInvalidField) {
                firstInvalidField = input;
            }

            const feedback = input.closest('.form-group')
                ?.querySelector('.invalid-feedback');

            if (feedback) {
                feedback.innerText = errors[field][0];
                feedback.style.display = 'block';
            }
        });

        if (firstInvalidField) {
            firstInvalidField.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            setTimeout(() => firstInvalidField.focus(), 300);
        }
    }
});
