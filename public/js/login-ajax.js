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
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json'
            },
            body: new FormData(form),
            credentials: 'same-origin'
        })
        .then(async res => {
            if (res.status === 422) throw await res.json();
            if (!res.ok) throw { message: 'Invalid credentials' };
            return res.json();
        })
        .then(data => {
            messageBox.className = 'login-message alert alert-success';
            messageBox.textContent = data.message || 'Login successful';
            messageBox.classList.remove('d-none');

            setTimeout(() => {
                window.location.href = data.redirect || '/';
            }, 1200);
        })
        .catch(err => {
            messageBox.className = 'login-message alert alert-danger';
            messageBox.textContent =
                err.message || 'Email or password is incorrect';
            messageBox.classList.remove('d-none');
        });
    });
});
