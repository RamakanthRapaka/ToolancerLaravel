document.addEventListener('DOMContentLoaded', () => {

    const singleForm = document.getElementById('toolUploadForm');
    const btnSingle = document.getElementById('submitBtnSingle');
    const successSingle = document.getElementById('successBoxSingle');

    singleForm.addEventListener('submit', e => {
        e.preventDefault();
        successSingle.classList.add('d-none');
        successSingle.innerText = '';

        if (!singleForm.checkValidity()) {
            singleForm.classList.add('was-validated');
            return;
        }

        btnSingle.disabled = true;
        btnSingle.innerText = 'Submitting...';
        const formData = new FormData(singleForm);

        fetch(singleForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': singleForm.querySelector('[name=_token]').value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
            .then(async res => {
                btnSingle.disabled = false;
                btnSingle.innerText = 'Submit';

                if (!res.ok && res.status !== 422) {
                    alert('Unexpected error. Please try again.');
                    return;
                }

                if (res.status === 422) {
                    const data = await res.json();
                    showErrors(singleForm, data.errors);
                    return;
                }

                const data = await res.json();
                successSingle.classList.remove('d-none');
                successSingle.innerText = data.message;
                singleForm.reset();
                singleForm.querySelectorAll('.is-valid, .is-invalid').forEach(el => el.classList.remove('is-valid', 'is-invalid'));
                singleForm.classList.remove('was-validated');
            })
            .catch(() => {
                btnSingle.disabled = false;
                btnSingle.innerText = 'Submit';
                alert('Something went wrong');
            });
    });

    function showErrors(form, errors) {
        form.querySelectorAll('.invalid-feedback').forEach(el => el.innerText = '');
        let firstError = null;
        for (const field in errors) {
            const input = form.querySelector(`[name="${field}"]`);
            if (!input) continue;
            input.classList.add('is-invalid');
            const feedback = input.closest('.mb-3')?.querySelector('.invalid-feedback');
            if (feedback) feedback.innerText = errors[field][0];
            if (!firstError) firstError = input;
        }
        if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

});
