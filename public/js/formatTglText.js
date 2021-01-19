const tglText = document.querySelectorAll('p.tgl-text');
const dt = luxon.DateTime;
tglText.forEach(text => {
    text.textContent = dt.fromSQL(text.textContent).setLocale('id').toLocaleString(dt.DATE_MED);
});