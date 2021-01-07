document.querySelector("#foto_barang").addEventListener('change', function (e) {
    const imgFile = e.target.files[0];
    previewFoto(imgFile);
});

function previewFoto(file) {
    const imagePreviewer = document.querySelector('#preview_foto_barang');
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function (readerEvent) {
        imagePreviewer.src = readerEvent.target.result;
    }
}