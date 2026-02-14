document.addEventListener('DOMContentLoaded', () => {

    const bulkForm = document.getElementById('bulkUploadForm');
    const btnBulk = document.getElementById('submitBtnBulk');
    const successBulk = document.getElementById('successBoxBulk');

    bulkForm.addEventListener('submit', e => {
        e.preventDefault();
        successBulk.classList.add('d-none');
        successBulk.innerText = '';

        const formData = new FormData(bulkForm);
        btnBulk.disabled = true;
        btnBulk.innerText = 'Uploading...';

        fetch(bulkForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': bulkForm.querySelector('[name=_token]').value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
            .then(async res => {
                btnBulk.disabled = false;
                btnBulk.innerText = 'Upload Excel';

                if (!res.ok && res.status !== 422) {
                    alert('Unexpected error. Please try again.');
                    return;
                }

                if (res.status === 422) {
                    const data = await res.json();
                    alert('Validation failed: ' + JSON.stringify(data.errors));
                    return;
                }

                const data = await res.json();
                successBulk.classList.remove('d-none');
                successBulk.innerText = data.message;
                bulkForm.reset();
            })
            .catch(() => {
                btnBulk.disabled = false;
                btnBulk.innerText = 'Upload Excel';
                alert('Something went wrong');
            });
    });

});
