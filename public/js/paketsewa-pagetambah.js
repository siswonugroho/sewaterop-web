document.addEventListener('DOMContentLoaded', function (event) {
    const listIsiPaket = document.querySelector('.list-barang');
    const inputPaketFlag = listIsiPaket.querySelector('#isi-paket-flag');
    const btnOpenModal = document.querySelector('a[data-toggle=modal]');
    const modalDialog = document.querySelector('.modal');
    const modalBody = modalDialog.querySelector('.modal-body');
    const modalFooter = modalBody.nextElementSibling;
    const modalLoading = modalDialog.querySelector('#loading-list');
    const modalAlertError = modalFooter.querySelector('.alert');
    const modalInputJumlah = modalFooter.querySelector('input[type=number]');

    async function getListBarang() {
        try {
            modalLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/databarang/getListBarang`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
            });
            modalLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListBarang(responseJson);
            if (Object.keys(responseJson).length === 0) modalBody.innerHTML = '<p class="text-center">Daftar barang kosong<br>Tambahkan beberapa barang terlebih dahulu di halaman Barang.</p>';

        } catch (error) {
            modalBody.innerHTML = `<p class="text-center">Tidak dapat memuat daftar barang.<br>${error}</p>`;
            console.error(error);
        }
    }

    function renderListBarang(data) {
        modalBody.innerHTML = "";
        data.forEach(barang => {
            modalBody.insertAdjacentHTML('beforeend',
                `<div class="custom-control custom-radio">
    <input type="radio" id="${barang.id_barang}" name="item" value="${barang.nama_barang}" class="custom-control-input">
    <label class="custom-control-label" for="${barang.id_barang}">
        <h5 class="mb-1">${barang.nama_barang}</h5>
        <p class="text-secondary">Stok: <span class='stok-barang'>${barang.stok}</span></p>
    </label>
</div>`);
        });
    }

    modalFooter.querySelector('#tambahItem').addEventListener('click', function (e) {
        const radioBarang = modalBody.querySelectorAll('input[type=radio]');

        radioBarang.forEach(barang => {
            if (barang.checked) {
                const stokBarang = parseInt(barang.nextElementSibling.querySelector('.stok-barang').textContent);
                if (parseInt(modalInputJumlah.value) > stokBarang) {
                    this.setAttribute("data-dismiss", "none");
                    modalAlertError.classList.replace('d-none', 'show');
                } else {
                    this.setAttribute("data-dismiss", "modal");
                    modalAlertError.classList.replace('show', 'd-none');
                    listIsiPaket.insertAdjacentHTML('beforeend', `<div class="input-group list-item">
<input type="number" readonly name="paket[jumlah_barang][]" class="form-control bg-white jumlah" value="${modalInputJumlah.value}">
<input type="hidden" name="paket[id_barang][]" class="form-control bg-white jumlah" value="${barang.getAttribute('id')}">
<input type="text" readonly name="paket[nama_barang][]" class="form-control bg-white w-50 nama" value="${barang.value}">
<div class="input-group-append remove-btn">
    <a href="javascript:void(0)" class="text-decoration-none input-group-text">&times;</a>
</div>
</div>`);
                }
            }
        });
        validateListIsiPaket();
        removeBarangFromList();
    });

    function removeBarangFromList() {
        listIsiPaket.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.parentElement.remove();
                validateListIsiPaket();
            });
        });
        
    }

    btnOpenModal.addEventListener('click', function () {
        getListBarang();
    });

    function validateListIsiPaket() {
        if (listIsiPaket.querySelectorAll('.list-item').length === 0) {
            inputPaketFlag.value = '';
        } else {
            inputPaketFlag.value = 1;
        }
    }

    $(modalDialog).on('hidden.bs.modal', function (e) {
        modalAlertError.classList.replace('show', 'd-none');
        modalInputJumlah.value = 0;
    });

    validateListIsiPaket();
    removeBarangFromList();
});
