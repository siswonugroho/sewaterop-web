const sidebar= document.querySelector("aside");
const bottomNav = document.querySelector("nav");

const sidebarTitle = sidebar.getAttribute("data-title");
const bottomNavTitle = bottomNav.getAttribute("data-title");

const sidebarLinks = sidebar.querySelectorAll("a.nav-link");
const bottomNavLinks = bottomNav.querySelectorAll("a.nav-link");

sidebarLinks.forEach(link => {
    if (sidebarTitle == link.innerText.trim()) {
        link.classList.toggle("text-secondary");
    }
});
bottomNavLinks.forEach(link => {
    if (bottomNavTitle == link.innerText.trim()) {
        link.classList.toggle("text-secondary");
    }
});