document.addEventListener('DOMContentLoaded', function (e) {
    const downloadStrukBtn = document.querySelector('a#downloadStruk');
    
    html2canvas(document.querySelector('.gambar-struk'), {
        scrollY: -window.scrollY
    }).then(function (canvas) {
        var base64image = canvas.toDataURL("image/jpeg", 0.7);
        downloadStrukBtn.href = base64image;
    }); 
});
