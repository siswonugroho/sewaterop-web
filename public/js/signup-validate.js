const forms = document.forms[0];
const inputs = {
    "username": document.querySelector("input#username"),
    "password": document.querySelector("input#password"),
    "repassword": document.querySelector("input#repassword"),
}


inputs.username.addEventListener('input', function () {
    if (inputs.username.validity.valid) {
        isUsernameAlreadyExists();
    } else {
        if (inputs.username.validity.valueMissing) {
            inputs.username.nextElementSibling.innerText = "Harap masukkan username";
        } else if (inputs.username.validity.patternMismatch) {
            inputs.username.nextElementSibling.innerText = "Username harus terdiri dari huruf dan angka.";
        }
        inputs.username.classList.add('is-invalid');
    }
});

inputs.password.addEventListener('input', function () {
    if (inputs.password.validity.valid) {
        inputs.password.classList.replace('is-invalid', 'is-valid');
    } else {
        if (inputs.password.validity.valueMissing) {
            inputs.password.nextElementSibling.innerText = "Harap masukkan password";
        } else if (inputs.password.validity.patternMismatch) {
            inputs.password.nextElementSibling.innerText = "Password harus terdiri dari huruf dan angka.";
        } else if (inputs.password.validity.tooShort) {
            inputs.password.nextElementSibling.innerText = "Password harus minimal 8 karakter.";
        }
        inputs.password.classList.add('is-invalid');
    }
});

inputs.repassword.addEventListener('input', function () {
    if (inputs.repassword.validity.valid) {
        if (inputs.repassword.value != inputs.password.value) {
            inputs.repassword.nextElementSibling.innerText = "Password tidak cocok. Coba lagi.";
            inputs.repassword.classList.add('is-invalid');
        } else {
            inputs.repassword.classList.replace('is-invalid', 'is-valid');
        }
    } else {
        if (inputs.repassword.validity.valueMissing) {
            inputs.repassword.nextElementSibling.innerText = "Harap masukkan password";
        }
        inputs.repassword.classList.add('is-invalid');
    }
});

forms.addEventListener('submit', function (event) {
    for (input in inputs) {
        if (!inputs[input].validity.valid || inputs[input].classList.contains('is-invalid')) {
            event.preventDefault();
        }
    }
})

async function isUsernameAlreadyExists() {
    try {
        const response = await fetch('http://localhost/sewaterop/public/signup/getUsername', {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `username=${inputs.username.value}`
        });
        if (response.ok) {
            const responseText = await response.text();
            if (responseText == 1) {
                inputs.username.classList.add('is-invalid');
                inputs.username.nextElementSibling.innerText = "Username ini sudah terdaftar.";
            } else inputs.username.classList.replace('is-invalid', 'is-valid');
        } else {
            inputs.username.nextElementSibling.innerText = "Tidak dapat memeriksa ketersediaan username";
        }
    } catch (error) {
        inputs.username.classList.add('is-invalid');
        inputs.username.nextElementSibling.innerText = "Tidak dapat memeriksa ketersediaan username";
    }
}







