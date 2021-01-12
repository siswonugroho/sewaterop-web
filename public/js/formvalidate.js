const formElement = document.forms[0];
const formInputs = formElement.elements;
const headerElement = document.querySelector('header');

formElement.addEventListener('submit', function (e) {
    for (let i = 0; i < formInputs.length; i++) {
        if (!formInputs[i].validity.valid) {
            e.preventDefault();
//             headerElement.insertAdjacentHTML('afterend', `<div class="alert alert-danger alert-dismissible fade show px-3" role="alert">
// <svg class="bi text-danger mr-2" width="24" height="24" fill="currentColor">
//     <use xlink:href="${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#x-circle" />
// </svg>
// Harap isi semua form
// <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
// </button>
// </div>`);
            formInputs[i].classList.add('is-invalid');
        } else {
            formInputs[i].classList.remove('is-invalid');
        }
    }
})
