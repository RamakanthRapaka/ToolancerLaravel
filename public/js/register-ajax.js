document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.ajax-form').forEach(form => {

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

        form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });

        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
        });

        Object.keys(errors).forEach(field => {

            let input =
                form.querySelector(`[name="${field}"]`) ||
                form.querySelector(`[name="${field}[]"]`);

            if (!input) return;

            input.classList.add('is-invalid');

            const feedback = input.closest('.form-group')
                ?.querySelector('.invalid-feedback');

            if (feedback) {
                feedback.innerText = errors[field][0];
                feedback.style.display = 'block';
            }
        });

        form.classList.add('was-validated');
    }
});
