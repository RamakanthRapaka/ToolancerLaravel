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
