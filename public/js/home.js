document.addEventListener('DOMContentLoaded', function (event) {
    const segeraBerakhirList = document.querySelector('.segera-berakhir').querySelector('.list-group');
    const sewaTerbaruList = document.querySelector('.sewa-terbaru').querySelector('.list-group');
    const btnTryAgain = document.querySelectorAll('button.try-again');
    const dt = luxon.DateTime;

    async function getListTop5(listElement, url = '', btnTryAgainIndex = 0) {
        const noListElement = listElement.querySelector('.no-list');
        try {
            noListElement.classList.remove('.d-none');
            noListElement.textContent = 'Memuat...';
            const response = await fetch(`${BASEURL}/home/${url}`);
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();

            if (Object.keys(responseJson).length === 0) {
                noListElement.classList.remove('d-none');
                noListElement.textContent = 'Tidak ada data';
            } else {
                noListElement.classList.add('d-none');
                btnTryAgain[btnTryAgainIndex].classList.add('d-none');
                if (listElement == segeraBerakhirList) {
                    renderListSegeraBerakhir(responseJson);
                } else if (listElement == sewaTerbaruList) {
                    renderListSewaTerbaru(responseJson);
                }
            }

        } catch (error) {
            noListElement.textContent = 'Error: Tidak dapat memuat daftar.';
            noListElement.classList.remove('d-none');
            btnTryAgain[btnTryAgainIndex].classList.remove('d-none');
        }
    }

    function renderListSegeraBerakhir(data) {
        segeraBerakhirList.innerHTML = '';
        data.forEach(item => {
            segeraBerakhirList.insertAdjacentHTML('beforeend', `<a href="${BASEURL}/datasewaan/details/viewdetail/${item.id_pesanan}" class="list-group-item list-group-item-action">
    <h5>${item.id_pesanan.toUpperCase()} - ${item.nama_pemesan}</h5>
    <p class="text-secondary m-0">Berakhir <span class="days-text">${dateRangeToToday(item.tgl_selesai)} hari lagi</span></p>
</a>`);
        });

        const daysText = segeraBerakhirList.querySelectorAll('span.days-text');
        daysText.forEach(text => {
            const daysTextDigit = text.textContent.match(/\d+/g);
            if (daysTextDigit[0] == 0) text.textContent = 'hari ini';
            else if (daysTextDigit[0] == 1) text.textContent = 'besok';
        })
    }

    function renderListSewaTerbaru(data) {
        sewaTerbaruList.innerHTML = '';
        data.forEach(item => {
            sewaTerbaruList.insertAdjacentHTML('beforeend', `<a href="${BASEURL}/datasewaan/details/viewdetail/${item.id_pesanan}" class="list-group-item list-group-item-action">
    <h5>${item.id_pesanan.toUpperCase()} - ${item.nama_pemesan}</h5>
    <p class="text-secondary m-0">${formatDate(item.tgl_mulai, dt.DATE_MED)} - ${formatDate(item.tgl_selesai, dt.DATE_MED)}</p>
</a>`);

        });
    }

    function dateRangeToToday(dateString) {
        const end = dt.fromSQL(dateString);
        const diffInDays = end.diffNow('days');
        const diffObj = diffInDays.toObject();
        return Math.floor(diffObj.days + 1);
    }

    btnTryAgain.forEach(btn => {
        if (btn.classList.contains('sewa-terbaru')) {
            btn.addEventListener('click', function () {
                getListTop5(sewaTerbaruList, 'getsewaterbaru', 0);
            });
        }
        else if (btn.classList.contains('segera-berakhir')) {
            btn.addEventListener('click', function () {
                getListTop5(segeraBerakhirList, 'getsewaakanberakhir', 1);
            })
        }
    });

    getListTop5(segeraBerakhirList, 'getsewaakanberakhir', 1);
    getListTop5(sewaTerbaruList, 'getsewaterbaru', 0);
});
