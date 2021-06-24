document.addEventListener('DOMContentLoaded', function (e) {
    const totalBiayaInput = document.querySelector('input.total-biaya');
    const kembalianText = document.querySelector('p.kembalian');
    const kembalianInput = document.querySelector('input.kembalian');
    const inputJumlahBayar = document.querySelector('input#jumlah_bayar');
    const statusSewaText = document.querySelector('p.status-sewa');

    function checkKembalian() {
        if (inputJumlahBayar.value != '') {
            kembalianInput.value = parseInt(inputJumlahBayar.value) - parseInt(totalBiayaInput.value);
            if (kembalianInput.value >= 0) {
                kembalianText.textContent = `Rp.${formatRupiah(kembalianInput.value)}`;
                statusSewaText.classList.replace('text-danger', 'text-success');
                statusSewaText.textContent = "Lunas";
                statusSewaText.nextElementSibling.value = "Lunas";
            } else {
                kembalianText.textContent = `Rp.${formatRupiah(0)}`;
                statusSewaText.classList.replace('text-success', 'text-danger');
                statusSewaText.textContent = `Kurang Rp.${formatRupiah(kembalianInput.value.replace('-', ''))}`;
                statusSewaText.nextElementSibling.value = statusSewaText.textContent;
            }
        } else {
            kembalianInput.value = 0;
            kembalianText.textContent = `Rp.${formatRupiah(0)}`;
            statusSewaText.classList.replace('text-success', 'text-danger');
            statusSewaText.textContent = `-`;
            statusSewaText.nextElementSibling.value = statusSewaText.textContent;
        }
    }

    inputJumlahBayar.addEventListener('input', checkKembalian);

    checkKembalian();
});