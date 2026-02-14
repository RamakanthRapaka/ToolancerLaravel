document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('toolUploadForm');
    const btn = document.getElementById('submitBtn');
    const successBox = document.getElementById('successBox');

    form.addEventListener('submit', e => {
        e.preventDefault();

        successBox.classList.add('d-none');
        successBox.innerText = '';

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        btn.disabled = true;
        btn.innerText = 'Submitting...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
            .then(async res => {
                btn.disabled = false;
                btn.innerText = 'Submit';

                if (!res.ok && res.status !== 422) {
                    alert('Unexpected error. Please try again.');
                    return;
                }

                if (res.status === 422) {
                    const data = await res.json();
                    showErrors(data.errors);
                    return;
                }

                const data = await res.json();
                successBox.classList.remove('d-none');
                successBox.innerText = data.message;
                form.reset();

                // also remove any leftover states
                form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
                    el.classList.remove('is-valid', 'is-invalid');
                });

                form.classList.remove('was-validated');
            })
            .catch(() => {
                btn.disabled = false;
                btn.innerText = 'Submit';
                alert('Something went wrong');
            });
    });

    function showErrors(errors) {
        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.innerText = '';
        });

        let firstError = null;

        for (const field in errors) {
            const input = form.querySelector(`[name="${field}"]`);
            if (!input) continue;

            // ❌ Remove green tick if present
            input.classList.remove('is-valid');

            // ✅ Force red error
            input.classList.add('is-invalid');

            const feedback = input.closest('.mb-3')?.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.innerText = errors[field][0];
            }

            if (!firstError) {
                firstError = input;
            }
        }

        if (firstError) {
            firstError.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            firstError.focus();
        }
    }

    form.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', () => {
            el.classList.remove('is-invalid');
        });

        el.addEventListener('change', () => {
            el.classList.remove('is-invalid');
        });
    });

});