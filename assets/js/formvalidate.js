const formElement = document.forms[0];
const formInputs = formElement.elements;
const headerElement = document.querySelector('header');

formElement.addEventListener('submit', function (e) {
    for (let i = 0; i < formInputs.length; i++) {
        if (!formInputs[i].validity.valid) {
            e.preventDefault();
            formInputs[i].classList.add('is-invalid');
        } else {
            formInputs[i].classList.remove('is-invalid');
        }
    }
})
