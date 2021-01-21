document.addEventListener('DOMContentLoaded', function (event) {
    const listSewaanContainer = document.querySelector("div#list-sewaan-container");
    const listSewaanLoading = listSewaanContainer.querySelector("span#loading-list");
    const listSewaanEmptyMessage = listSewaanContainer.querySelector(".list-sewaan-empty-message");
    const listGroupElement = listSewaanContainer.querySelector("div.list-group");
    const dialogDataElement = document.querySelectorAll(".selected-data");

    function countDataSewaan(listParent) {
        const angkaText = document.querySelector("#total-sewaan");
        angkaText.innerText = listParent.children.length.toString();
    }

    async function getListSewaan() {
        try {
            listSewaanLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/datasewaan/getListSewaan`, {
                method: "GET"
            });
            listSewaanLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListSewaan(responseJson);
            countDataSewaan(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                toggleListEmpty('hide');
                const listSewaan = new List('list-sewaan', {
                    valueNames: ['nama', 'barang-sewaan', 'tgl', 'last-added']
                });
                listSewaan.sort('last-added', { order: "desc" });
                listSewaan.on('searchComplete', function () {
                    if (listSewaan.matchingItems.length === 0) {
                        toggleListEmpty('show', 'search', 'Hasil pencarian tidak ditemukan', 'Coba masukkan kata kunci lain yang lebih umum.');
                    } else {
                        toggleListEmpty('hide');
                    }
                });
            } else {
                toggleListEmpty('show', 'emoji-frown', 'Tidak ada sewaan disini', 'Tambahkan sewaan baru dengan pilihan barang dan harga terbaik bagi konsumen Anda sekarang.')
            }

        } catch (error) {
            listSewaanLoading.classList.add("d-none");
            toggleListEmpty('show', 'x-circle', 'Gagal memuat daftar sewaan', 'Coba lagi nanti atau refresh halaman ini.');
            console.error(error);
        }
    }

    function renderListSewaan(dataSewaan) {
        listGroupElement.innerHTML = "";
        const dt = luxon.DateTime;
        dataSewaan.forEach(sewaan => {
            let barangSewaanText = ''
            if (sewaan.nama_paket.startsWith('sw')) {
                let barang_sewaan = [];
                for (let i = 0; i < sewaan.barang_sewaan.nama_barang.length; i++) {
                    barang_sewaan.push(`${sewaan.barang_sewaan.jumlah_barang[i]} ${sewaan.barang_sewaan.nama_barang[i]}`);
                }
                barangSewaanText = barang_sewaan.join(', ');
            } else {
                barangSewaanText = `Paket sewa ${sewaan.nama_paket}`;
            }

            listGroupElement.insertAdjacentHTML("beforeend", `
<div class="list-group-item anim-fade">
    <span class="d-flex w-100 justify-content-between">
        <h5 class="nama mb-0">${sewaan.id_pesanan.toUpperCase()} - ${sewaan.nama_pemesan}</h5>
        <div class="dropdown p-0">
            <button class="btn text-primary p-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <svg class="bi" width="24" height="24" fill="currentColor">
                    <use xlink:href="${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#three-dots" />
                </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-right anim-fade shadow">
                <a href="${BASEURL}/datasewaan/details/pageedit/${sewaan.id_pesanan}" class="dropdown-item">Edit</a>
                <a href="" class="dropdown-item text-danger" data-toggle="modal" data-target="#dialogHapus" data-id-sewaan="${sewaan.id_pesanan}" data-id-paket="${sewaan.id_paket}" data-nama-sewaan="${sewaan.nama_pemesan}">Hapus</a>
            </div>
        </div>
    </span>
    <p class="text-muted my-0 barang-sewaan">${barangSewaanText}</p>
    <p class="text-muted my-0 tgl">${dt.fromSQL(sewaan.tgl_mulai).setLocale('id').toLocaleString(dt.DATE_MED)} s/d ${dt.fromSQL(sewaan.tgl_selesai).setLocale('id').toLocaleString(dt.DATE_MED)}</p>
    <p class="d-none last-added">${sewaan.id_pesanan}</p>
    <a href="${BASEURL}/datasewaan/details/viewdetail/${sewaan.id_pesanan}" class="btn btn-outline-primary mt-2">Detail</a>
</div>`);
            
        });

        listGroupElement.querySelectorAll("a[data-toggle=modal]").forEach(btn => {
            btn.addEventListener('click', function () {
                dialogDataElement.forEach(element => {
                    if (element.tagName == "A") element.setAttribute("href", `${BASEURL}/datasewaan/hapus/${btn.getAttribute("data-id-sewaan")}/${btn.getAttribute("data-id-paket")}`);
                    else element.textContent = btn.getAttribute("data-nama-sewaan");
                });
            });
        });
    }

    function toggleListEmpty(toggle, iconName = "", messageTitle = "", messageDetail = "") {
        switch (toggle) {
            case "show":
                listSewaanEmptyMessage.classList.replace("d-none", "d-flex");
                listSewaanEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#${iconName}`);
                listSewaanEmptyMessage.children[1].textContent = messageTitle;
                listSewaanEmptyMessage.children[2].textContent = messageDetail;
                break;
            case "hide":
                listSewaanEmptyMessage.classList.replace("d-flex", "d-none");
                break;
        }
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListSewaan();
    });

    getListSewaan();


})