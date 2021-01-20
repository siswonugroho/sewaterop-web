const downloadStrukBtn = document.querySelector('a#downloadStruk');
html2canvas(document.querySelector('.gambar-struk'), {
    scrollY: -window.scrollY
}).then(function (canvas) {
    var base64image = canvas.toDataURL("image/png");
    downloadStrukBtn.href = base64image;
});
// downloadStrukBtn.addEventListener('click', function () {
//     window.scrollTo(0,0)
// })
