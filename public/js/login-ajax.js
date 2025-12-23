document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('loginForm');
    if (!form) return;

    const messageBox = document.querySelector('.login-message');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: new FormData(form)
        })
        .then(res => res.json().then(data => ({ ok: res.ok, data })))
        .then(({ ok, data }) => {

            if (!ok) {
                throw data;
            }

            messageBox.className = 'login-message alert alert-success';
            messageBox.textContent = 'Login successful. Redirecting...';
            messageBox.classList.remove('d-none');

            setTimeout(() => {
                window.location.href = data.redirect;
            }, 800);
        })
        .catch(err => {
            messageBox.className = 'login-message alert alert-danger';
            messageBox.textContent = err.message || 'Login failed';
            messageBox.classList.remove('d-none');
        });
    });
});
