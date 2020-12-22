const navTitle = document.querySelector("nav").getAttribute("data-title");
const navLinks = document.querySelectorAll("a.nav-link");

navLinks.forEach(link => {
    if (navTitle == link.innerText) {
        link.classList.toggle("font-weight-bold");
    }
});
