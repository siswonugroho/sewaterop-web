document.addEventListener('DOMContentLoaded', function (event) {
    const listRiwayatContainer = document.querySelector("div#list-riwayat-container");
    const listRiwayatLoading = listRiwayatContainer.querySelector("span#loading-list");
    const listRiwayatEmptyMessage = listRiwayatContainer.querySelector(".list-riwayat-empty-message");
    const listGroupElement = listRiwayatContainer.querySelector("div.list-group");
    const dialogDataElement = document.querySelectorAll(".selected-data");

    function countDataRiwayat(listParent) {
        const angkaText = document.querySelector("#total-riwayat");
        angkaText.innerText = listParent.children.length.toString();
    }

    async function getListRiwayat() {
        try {
            listRiwayatLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/datariwayat/getListRiwayat`);
            listRiwayatLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListRiwayat(responseJson);
            countDataRiwayat(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                toggleListEmpty('hide');
                const listRiwayat = new List('list-riwayat', {
                    valueNames: ['nama', 'last-added']
                });
                listRiwayat.sort('last-added', { order: "desc" });
                listRiwayat.on('searchComplete', function () {
                    if (listRiwayat.matchingItems.length === 0) {
                        toggleListEmpty('show', 'search', 'Hasil pencarian tidak ditemukan', 'Coba masukkan kata kunci lain yang lebih umum.');
                    } else {
                        toggleListEmpty('hide');
                    }
                });
            } else {
                toggleListEmpty('show', 'emoji-frown', 'Tidak ada riwayat disini', 'Semua transaksi sewaan yang sudah selesai akan tersimpan disini.');
            }

        } catch (error) {
            listRiwayatLoading.classList.add("d-none");
            toggleListEmpty('show', 'x-circle', 'Gagal memuat daftar riwayat', 'Coba lagi nanti atau refresh halaman ini.');
            console.error(error);
        }
    }

    function renderListRiwayat(dataRiwayat) {
        listGroupElement.innerHTML = "";
        const dt = luxon.DateTime;
        dataRiwayat.forEach(riwayat => {
            listGroupElement.insertAdjacentHTML("beforeend", `
<div class="list-group-item anim-fade">
<div class="row">
    <div class="col-9">
    <h5>${riwayat.id_pesanan.toUpperCase()} - <span class="nama">${riwayat.nama_pemesan}</span></h5>
    <p class="text-muted my-0 tgl">${dt.fromSQL(riwayat.tgl_mulai).setLocale('id').toLocaleString(dt.DATE_MED)} s/d ${dt.fromSQL(riwayat.tgl_selesai).setLocale('id').toLocaleString(dt.DATE_MED)}</p>
    <p class="my-0 status">${riwayat.status_pembayaran}</p>
    <p class="d-none last-added">${riwayat.id_pesanan}</p>
    </div>
    <div class="col-md">
    <a href="${BASEURL}/datariwayat/viewreport/${riwayat.id_pesanan}" class="btn btn-primary my-2 my-md-1 text-truncate">Lihat Struk</a>
    <a data-toggle="modal" data-target="#dialogHapus" data-id-sewaan="${riwayat.id_pesanan}" data-id-paket="${riwayat.id_paket}" data-nama-penyewa="${riwayat.nama_pemesan}" class="btn btn-danger my-2 my-md-1 text-truncate">Hapus</a>
    </div>
</div>
</div>`);

        });
        const statusPembayaranText = listGroupElement.querySelectorAll('p.status');
        statusPembayaranText.forEach(status => {
            if (status.textContent.startsWith('L')) {
                status.classList.add('font-weight-bold', 'text-success');
            } else if (status.textContent.startsWith('K')) {
                status.classList.add('font-weight-bold', 'text-danger');
            }
        })


        listGroupElement.querySelectorAll("a[data-toggle=modal]").forEach(btn => {
            btn.addEventListener('click', function () {
                dialogDataElement.forEach(element => {
                    if (element.tagName == "A") element.setAttribute("href", `${BASEURL}/datasewaan/hapus/${btn.getAttribute("data-id-sewaan")}/${btn.getAttribute("data-id-paket")}`);
                    else element.textContent = btn.getAttribute("data-nama-penyewa");
                });
            });
        });
    }

    function toggleListEmpty(toggle, iconName = "", messageTitle = "", messageDetail = "") {
        switch (toggle) {
            case "show":
                listRiwayatEmptyMessage.classList.replace("d-none", "d-flex");
                listRiwayatEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#${iconName}`);
                listRiwayatEmptyMessage.children[1].textContent = messageTitle;
                listRiwayatEmptyMessage.children[2].textContent = messageDetail;
                break;
            case "hide":
                listRiwayatEmptyMessage.classList.replace("d-flex", "d-none");
                break;
        }
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListRiwayat();
    });

    getListRiwayat();


})