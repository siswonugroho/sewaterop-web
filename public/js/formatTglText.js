const tglText = document.querySelectorAll('.tgl-text');
const dt = luxon.DateTime;
tglText.forEach(text => {
    text.textContent = dt.fromISO(text.textContent).setLocale('id').toLocaleString(dt.DATE_MED);
});