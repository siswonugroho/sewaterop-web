
document.addEventListener('DOMContentLoaded', function (event) {
    const formPilihPaket = document.querySelector('.pilih-paket');
    const formPilihBarang = document.querySelector('.list-barang');
    const togglePilihBarangDari = document.querySelectorAll('input[type=radio][name=tipe_sewaan]');
    const dropdownPenyewa = document.querySelector('.daftar-penyewa');
    const daftarPaketSewa = document.querySelector('.daftar-paket-sewa');
    const dataIdPaket = daftarPaketSewa.getAttribute('data-id-paket');

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
            const response = await fetch(`${BASEURL}/databarang/getListBarang`);
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

    async function getListNamaPenyewa() {
        try {
            const response = await fetch(`${BASEURL}/datapenyewa/getlistpenyewa`);
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListPenyewa(responseJson);
        } catch (error) {
            dropdownPenyewa.insertAdjacentHTML('beforeend', `<p class="m-3 text-muted">Tidak dapat mengambil daftar nama penyewa</p>`);
        }
    }

    async function getListPaketSewa() {
        try {
            const response = await fetch(`${BASEURL}/datapaketsewa/getlistpaket`);
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListPaketSewa(responseJson);
        } catch (error) {
            daftarPaketSewa.insertAdjacentHTML('beforeend', `<p class="m-3 text-muted">Tidak dapat mengambil daftar paket sewa</p>`);
        }
    }

    function renderListPaketSewa(data) {
        daftarPaketSewa.innerHTML = '';
        Object.keys(data).forEach(key => {
            daftarPaketSewa.insertAdjacentHTML('beforeend', `<div class="col p-1 btn-group-toggle"><label class="btn btn-outline-dark w-100 text-left text-truncate">
      <input type="radio" name="id_paket" value="${data[key].id_paket}"> <small>${data[key].nama_paket}</small><br>Rp.${formatRupiah(data[key].harga)}
      </label></div>`);
        });

        const radioPaketSewa = document.querySelectorAll('input[name=id_paket]');
        radioPaketSewa.forEach(radio => {
            if (radio.value === dataIdPaket) radio.checked = true;

            if (radio.checked) radio.parentElement.classList.add('active');
            else radio.parentElement.classList.remove('active');
        });
    }

    function renderListBarang(data) {
        modalBody.innerHTML = "";
        data.forEach(barang => {
            modalBody.insertAdjacentHTML('beforeend', `<div class="custom-control custom-radio">
    <input type="radio" id="${barang.id_barang}" name="item" value="${barang.nama_barang}" class="custom-control-input">
    <label class="custom-control-label" for="${barang.id_barang}">
        <h5 class="mb-1">${barang.nama_barang}</h5>
        <p class="text-secondary">Stok: <span class='stok-barang'>${barang.stok}</span></p>
        <p class="d-none harga-barang">${barang.harga}</p>
    </label>
</div>`);
        });
    }

    function renderListPenyewa(data) {
        dropdownPenyewa.innerHTML = '';
        data.forEach(penyewa => {
            dropdownPenyewa.insertAdjacentHTML('beforeend', `<a class="dropdown-item list-penyewa" data-id-penyewa="${penyewa.id_pemesan}"><span class="nama-penyewa">${penyewa.nama_pemesan}</span><br><small class="text-muted">${penyewa.alamat}</small></a>`);
        });

        const inputPenyewaElement = document.querySelector('input#nama_penyewa');
        const idPenyewaElement = document.querySelector('input#id_penyewa');
        const listPenyewa = document.querySelectorAll('a.list-penyewa');
        listPenyewa.forEach(list => {
            list.addEventListener('click', function () {
                inputPenyewaElement.value = list.querySelector('.nama-penyewa').textContent;
                idPenyewaElement.value = list.getAttribute('data-id-penyewa');
            });
        });
    }

    modalFooter.querySelector('#tambahItem').addEventListener('click', function (e) {
        const radioBarang = modalBody.querySelectorAll('input[type=radio]');

        radioBarang.forEach(barang => {
            if (barang.checked) {
                const stokBarang = parseInt(barang.nextElementSibling.querySelector('.stok-barang').textContent);
                const hargaBarang = parseInt(barang.nextElementSibling.querySelector('.harga-barang').textContent);
                if (parseInt(modalInputJumlah.value) > stokBarang) {
                    this.setAttribute("data-dismiss", "none");
                    modalAlertError.classList.replace('d-none', 'show');
                } else {
                    this.setAttribute("data-dismiss", "modal");
                    modalAlertError.classList.replace('show', 'd-none');
                    listIsiPaket.insertAdjacentHTML('beforeend', `<div class="input-group list-item">
<input type="number" readonly name="paket[jumlah_barang][]" class="form-control bg-white jumlah" value="${modalInputJumlah.value}">
<input type="hidden" name="paket[id_barang][]" class="jumlah" value="${barang.getAttribute('id')}">
<input type="text" readonly name="paket[nama_barang][]" class="form-control bg-white w-50 nama" value="${barang.value}">
<input type="hidden" name="paket[harga][]" class="harga" value="${hargaBarang}">
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

    function validateListIsiPaket() {
        if (listIsiPaket.querySelectorAll('.list-item').length === 0) {
            inputPaketFlag.value = '';
        } else {
            inputPaketFlag.value = 1;
        }
    }

    btnOpenModal.addEventListener('click', function () {
        getListBarang();
    });


    $(modalDialog).on('hidden.bs.modal', function (e) {
        modalAlertError.classList.replace('show', 'd-none');
        modalInputJumlah.value = 0;
    });

    togglePilihBarangDari.forEach(radio => {
        radio.addEventListener('click', function () {
            if (togglePilihBarangDari[0].checked) {
                formPilihPaket.classList.replace('d-none', 'd-block');
                formPilihBarang.classList.replace('d-block', 'd-none');
                formPilihPaket.querySelectorAll('input').forEach(input => {
                    input.removeAttribute('disabled');
                });
                formPilihBarang.querySelectorAll('input').forEach(input => {
                    input.setAttribute('disabled', '');
                });
                getListPaketSewa();
            } else if (togglePilihBarangDari[1].checked) {
                formPilihPaket.classList.replace('d-block', 'd-none');
                formPilihBarang.classList.replace('d-none', 'd-block');
                formPilihBarang.querySelectorAll('input').forEach(input => {
                    input.removeAttribute('disabled');
                });
                formPilihPaket.querySelectorAll('input').forEach(input => {
                    input.setAttribute('disabled', '');
                });
            }
        });
    });

    getListNamaPenyewa();
    getListPaketSewa();
    validateListIsiPaket();
    removeBarangFromList();
});
