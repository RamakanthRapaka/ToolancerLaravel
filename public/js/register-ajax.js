document.addEventListener('DOMContentLoaded', function () {

    /**
     * Handle all ajax forms
     */
    document.querySelectorAll('.ajax-form').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // 🔹 Native browser validation first
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(async res => {

                    // ❌ Laravel validation error
                    if (res.status === 422) {
                        const data = await res.json();
                        throw data;
                    }

                    // ❌ Any other server error
                    if (!res.ok) {
                        throw { message: 'Something went wrong. Please try again.' };
                    }

                    // ✅ Success
                    return res.json();
                })
                .then(data => {

                    // Reset form
                    form.reset();
                    form.classList.remove('was-validated');

                    // Reset selectpicker
                    $(form).find('.selectpicker').selectpicker('refresh');

                    alert(data.message || 'Registration successful');

                    // Close offcanvas
                    const offcanvasEl = document.getElementById('loginslide');
                    const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                    offcanvas?.hide();
                })
                .catch(err => {

                    // ✅ Map Laravel validation errors
                    if (err.errors) {
                        showErrors(form, err.errors);
                    } else if (err.message) {
                        alert(err.message);
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
        });
    });

    /**
     * Map Laravel validation errors to UI
     */
    function showErrors(form, errors) {

        // Clear old errors
        form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });

        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.innerText = '';
            el.style.display = 'none';
        });

        Object.keys(errors).forEach(field => {

            let input =
                form.querySelector(`[name="${field}"]`) ||
                form.querySelector(`[name="${field}[]"]`);

            if (!input) return;

            // 🔹 FILE INPUT (profileFile)
            if (input.type === 'file') {
                input.classList.add('is-invalid');

                const feedback = input.parentElement
                    ?.querySelector('.profileFile-error');

                if (feedback) {
                    feedback.innerText = errors[field][0];
                    feedback.style.display = 'block';
                }
                return;
            }

            // 🔹 SELECTPICKER
            if (input.classList.contains('selectpicker')) {
                const wrapper = input.closest('.bootstrap-select');
                wrapper?.classList.add('is-invalid');

                const feedback = input.closest('.form-group')
                    ?.querySelector('.invalid-feedback');

                if (feedback) {
                    feedback.innerText = errors[field][0];
                    feedback.style.display = 'block';
                }
                return;
            }

            // 🔹 NORMAL INPUTS
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

    /**
     * Remove selectpicker error on change
     */
    $('.selectpicker').on('changed.bs.select', function () {
        $(this).closest('.bootstrap-select').removeClass('is-invalid');
    });

    /**
     * Remove file input error on change
     */
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
            input.classList.remove('is-invalid');

            const feedback = input.parentElement
                ?.querySelector('.profileFile-error');

            if (feedback) {
                feedback.innerText = '';
                feedback.style.display = 'none';
            }
        });
    });

});
