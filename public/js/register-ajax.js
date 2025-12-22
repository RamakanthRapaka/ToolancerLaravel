document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.ajax-form').forEach(form => {

        form.querySelectorAll('input, select, textarea').forEach(el => {
            ['input', 'change'].forEach(evt => {
                el.addEventListener(evt, function () {
                    this.classList.remove('is-invalid');

                    const feedback = this.closest('.form-group')
                        ?.querySelector('.invalid-feedback');

                    if (feedback) feedback.style.display = 'none';
                });
            });
        });

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

            const formData = new FormData(form);

            // 🔹 Message container inside THIS form
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

                    // ✅ Show success message at bottom
                    if (messageBox) {
                        messageBox.className = 'drawer-message alert alert-success';
                        messageBox.innerText = data.message || 'Registration successful';
                        messageBox.style.display = 'block';
                    }

                    form.reset();
                    form.classList.remove('was-validated');

                    if (typeof clearServerErrors === 'function') {
                        clearServerErrors(form);
                    }

                    if (typeof resetPasswordStrength === 'function') {
                        resetPasswordStrength(form);
                    }
                    if (typeof resetSelectPickers === 'function') {
                        resetSelectPickers(form);
                    }

                    // 🔹 Close drawer after delay (optional)
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
                    } else {
                        if (messageBox) {
                            messageBox.className = 'drawer-message alert alert-danger';
                            messageBox.innerText = err.message || 'Something went wrong';
                            messageBox.style.display = 'block';
                        }
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
        });
    });

    function showErrors(form, errors) {

        // 🔥 Remove Bootstrap validation state completely
        form.classList.remove('was-validated');

        form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
        });

        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
            el.innerText = '';
        });

        let firstInvalidField = null;

        Object.keys(errors).forEach(field => {

            let input =
                form.querySelector(`[name="${field}"]`) ||
                form.querySelector(`[name="${field}[]"]`);

            if (!input) return;

            // ❌ Mark invalid (server wins)
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');

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

        // ✅ AUTO-SCROLL + AUTO-FOCUS (NEW)
        if (firstInvalidField) {

            // Scroll smoothly
            firstInvalidField.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Focus (handle selectpicker separately)
            if (firstInvalidField.classList.contains('selectpicker')) {
                $(firstInvalidField).selectpicker('toggle');
            } else {
                setTimeout(() => firstInvalidField.focus(), 300);
            }
        }
    }
});
