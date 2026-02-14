document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");
    const messageBox = document.createElement("div");

    messageBox.classList.add("alert", "d-none");
    form.prepend(messageBox);

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Accept": "application/json"
            },
            credentials: "same-origin",   // ⭐ IMPORTANT
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                messageBox.className = "alert";

                if (data.status) {
                    messageBox.classList.add("alert-success");
                    messageBox.innerText = data.status;
                } else if (data.message) {
                    messageBox.classList.add("alert-danger");
                    messageBox.innerText = data.message;
                } else {
                    messageBox.classList.add("alert-danger");
                    messageBox.innerText = "Something went wrong.";
                }
            })
            .catch(() => {
                messageBox.className = "alert alert-danger";
                messageBox.innerText = "Server error.";
            });

    });

});
