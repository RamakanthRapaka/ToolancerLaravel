document.addEventListener('DOMContentLoaded', () => {
    const bulkForm = document.getElementById('bulkExcelForm');
    if (!bulkForm) return;

    const btnBulk = document.getElementById('btnUploadExcel');
    const fileInput = document.getElementById('excelFileInput');
    const btnUploadTool = document.getElementById('btnUploadTool');
    const btnDownloadSample = document.getElementById('btnDownloadSample');

    bulkForm.addEventListener('submit', async e => {
        e.preventDefault();

        // Check if a file is selected
        if (!fileInput.files.length || !fileInput.files[0]) {
            alert('Please select an Excel file.');
            return;
        }

        // Validate file type
        const file = fileInput.files[0];
        const validTypes = [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel'
        ];

        if (!validTypes.includes(file.type) && !file.name.match(/\.(xlsx|xls)$/i)) {
            alert('Please select a valid Excel file (.xlsx or .xls)');
            return;
        }

        console.log('File selected:', file.name, file.type, file.size); // DEBUG

        // Disable all relevant buttons while uploading
        [btnBulk, btnUploadTool, btnDownloadSample, fileInput].forEach(el => el.disabled = true);
        btnBulk.innerText = 'Uploading...';

        // Create FormData manually to ensure file is included
        const formData = new FormData();
        formData.append('excel_file', file);
        formData.append('_token', bulkForm.querySelector('[name=_token]').value);

        // DEBUG: Log FormData contents
        console.log('FormData contents:');
        for (let pair of formData.entries()) {
            console.log(pair[0], pair[1]);
        }

        try {
            const res = await fetch(bulkForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                    // Do NOT include X-CSRF-TOKEN here, we're sending it in FormData
                    // Do NOT set Content-Type - let browser set it with boundary
                },
                body: formData,
                credentials: 'same-origin'
            });

            // Re-enable buttons immediately after response
            [btnBulk, btnUploadTool, btnDownloadSample, fileInput].forEach(el => el.disabled = false);
            btnBulk.innerText = 'Upload Excel';

            console.log('Response status:', res.status); // DEBUG

            // Handle non-200 responses
            if (!res.ok) {
                let errorData;
                try {
                    errorData = await res.json();
                    console.log('Server error:', errorData);

                    // Show validation errors if available
                    if (errorData.errors) {
                        const errorMessages = Object.values(errorData.errors).flat().join('\n');
                        alert('Validation Error:\n' + errorMessages);
                    } else {
                        alert('Upload failed: ' + (errorData.message || 'Unknown error'));
                    }
                } catch (_) {
                    const text = await res.text();
                    console.log('Server returned non-JSON:', text);
                    alert('Upload failed. Check login or file format.');
                }
                return;
            }

            // Parse JSON response
            const data = await res.json();
            console.log('Success response:', data); // DEBUG

            if (data.status === false) {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
                return;
            }

            alert(data.message || 'Excel uploaded successfully!');

            bulkForm.reset();
            fileInput.value = ''; // Clear file input explicitly

            // Refresh DataTable to show new records
            if (window.$ && $('#toolsTable').length) {
                $('#toolsTable').DataTable().ajax.reload(null, false);
            }

        } catch (err) {
            // Re-enable buttons in case of exception
            [btnBulk, btnUploadTool, btnDownloadSample, fileInput].forEach(el => el.disabled = false);
            btnBulk.innerText = 'Upload Excel';
            console.error('Bulk upload error:', err);
            alert('Something went wrong. Please try again.');
        }
    });
});