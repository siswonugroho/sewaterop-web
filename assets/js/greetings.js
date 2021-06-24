const welcomeText = document.querySelector('#welcome-text');
const date = new Date();
let hours = date.getHours();

if (hours >= 3 && hours < 11) welcomeText.textContent = "Selamat pagi";
else if (hours >= 11 && hours < 15) welcomeText.textContent = "Selamat siang";
else if (hours >= 15 && hours < 19) welcomeText.textContent = "Selamat sore";
else welcomeText.textContent = "Selamat malam";