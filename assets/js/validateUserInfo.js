document.addEventListener('DOMContentLoaded', function () {
    const formElement = document.forms[0];
    const inputs = {
        "username": formElement.querySelector("input#username"),
        "username_lama": formElement.querySelector("input#username_lama")
    }

    inputs.username.addEventListener('input', async function () {
        try {
            const response = await fetch(`${BASEURL}/signup/getUsername`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `username=${inputs.username.value}`
            });
            if (!response.ok) {
                throw Error();
            }
            const responseText = await response.text();
            if (inputs.username.value != inputs.username_lama.value) {
                if (responseText == 1) {
                    inputs.username.classList.add('is-invalid');
                    inputs.username.nextElementSibling.innerText = "Username ini sudah terdaftar.";
                } else if (responseText == 0) inputs.username.classList.remove('is-invalid');
                else throw Error();
            }

        } catch (error) {
            inputs.username.classList.replace('is-valid', 'is-invalid');
            inputs.username.nextElementSibling.innerText = "Tidak dapat memeriksa ketersediaan username.";
        }
    });

    formElement.addEventListener('submit', function (e) {
        for (input in inputs) {
            if (!inputs[input].validity.valid || inputs[input].classList.contains('is-invalid')) {
                e.preventDefault();
                inputs[input].classList.add('is-invalid');
            } else {
                inputs[input].classList.remove('is-invalid');
            }
        }
    })

})