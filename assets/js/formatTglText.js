const tglText = document.querySelectorAll('.tgl-text');
const dt = luxon.DateTime;
tglText.forEach(text => {
    text.textContent = dt.fromSQL(text.textContent).setLocale('id').toLocaleString(dt.DATETIME_MED);
});