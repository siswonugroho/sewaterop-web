const forms = document.forms[0];
const inputs = {
    "username": document.querySelector("input#username"),
    "password": document.querySelector("input#password"),
}

inputs.username.addEventListener('input', function () {
    if (inputs.username.validity.valid) {
        inputs.username.classList.remove('is-invalid');
    } else {
        inputs.username.nextElementSibling.innerText = "Harap masukkan username";
        inputs.username.classList.add('is-invalid');
    }
});

inputs.password.addEventListener('input', function () {
    if (inputs.password.validity.valid) {
        inputs.password.classList.remove('is-invalid');
    } else {
        inputs.password.nextElementSibling.innerText = "Harap masukkan password";
        inputs.password.classList.add('is-invalid');
    }
});

forms.addEventListener('submit', function (event) {
    for (input in inputs) {
        if (!inputs[input].validity.valid || inputs[input].classList.contains('is-invalid')) {
            event.preventDefault();
        }
    }
})