document.addEventListener('DOMContentLoaded', function (event) {
    const segeraBerakhirList = document.querySelector('.segera-berakhir').querySelector('.list-group');
    const sewaTerbaruList = document.querySelector('.sewa-terbaru').querySelector('.list-group');
    const dt = luxon.DateTime;

    async function getListTop5(listElement, url) {
        const noListElement = listElement.querySelector('.no-list');
        try {
            noListElement.classList.remove('.d-none');
            const response = await fetch(`${BASEURL}/home/${url}`);
            noListElement.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();

            if (listElement == segeraBerakhirList) {
                renderListSegeraBerakhir(responseJson);
            } else if (listElement == sewaTerbaruList) {
                renderListSewaTerbaru(responseJson);
            }
            if (Object.keys(responseJson).length === 0) {
                noListElement.textContent = 'Tidak ada data.';
                noListElement.classList.remove('d-none');
            } else {
                noListElement.classList.add('d-none');
            }

        } catch (error) {
            noListElement.textContent = 'Error: Tidak dapat memuat daftar.';
            noListElement.classList.remove('d-none');
        }
    }

    function renderListSegeraBerakhir(data) {
        segeraBerakhirList.innerHTML = '';
        data.forEach(item => {
            segeraBerakhirList.insertAdjacentHTML('beforeend', `<a href="${BASEURL}/datasewaan/details/viewdetail/${item.id_pesanan}" class="list-group-item list-group-item-action">
    <h5>${item.id_pesanan.toUpperCase()} - ${item.nama_pemesan}</h5>
    <p class="text-secondary m-0">Berakhir pada ${dt.fromSQL(item.tgl_selesai).setLocale('id').toLocaleString(dt.DATE_MED)}</p>
</a>`);

        });
    }

    function renderListSewaTerbaru(data) {
        sewaTerbaruList.innerHTML = '';
        data.forEach(item => {
            sewaTerbaruList.insertAdjacentHTML('beforeend', `<a href="${BASEURL}/datasewaan/details/viewdetail/${item.id_pesanan}" class="list-group-item list-group-item-action">
    <h5>${item.id_pesanan.toUpperCase()} - ${item.nama_pemesan}</h5>
    <p class="text-secondary m-0">${dt.fromSQL(item.tgl_mulai).setLocale('id').toLocaleString(dt.DATE_MED)} s/d ${dt.fromSQL(item.tgl_selesai).setLocale('id').toLocaleString(dt.DATE_MED)}</p>
</a>`);

        });
    }

    getListTop5(segeraBerakhirList, 'getsewaakanberakhir');
    getListTop5(sewaTerbaruList, 'getsewaterbaru');
});
