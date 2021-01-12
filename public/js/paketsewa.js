document.addEventListener('DOMContentLoaded', function (event) {
    const listPaketContainer = document.querySelector("div#list-paket-container");
    const listPaketLoading = listPaketContainer.querySelector("span#loading-list");
    const listPaketEmptyMessage = listPaketContainer.querySelector(".list-paket-empty-message");
    const listGroupElement = listPaketContainer.querySelector("div.list-paket");
    const dialogDataElement = document.querySelectorAll(".selected-data");

    function countDataPaket(listParent) {
        const angkaText = document.querySelector("#total-paket");
        angkaText.innerText = listParent.children.length.toString();
    }

    async function getListPaket() {
        try {
            listPaketLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/datapaketsewa/getListPaket`, {
                method: "GET"
            });
            listPaketLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();

            renderListPaket(responseJson);
            countDataPaket(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                toggleListEmpty('hide');
                const listPaket = new List('list-paket', {
                    valueNames: ['nama', 'harga', 'last-added']
                });
                listPaket.sort('last-added', { order: "desc" });
                listPaket.on('searchComplete', function () {
                    if (listPaket.matchingItems.length === 0) {
                        toggleListEmpty('show', 'search', 'Hasil pencarian tidak ditemukan', 'Coba masukkan kata kunci lain yang lebih umum.');
                    } else {
                        toggleListEmpty('hide');
                    }
                });
            } else {
                toggleListEmpty('show', 'emoji-frown', 'Tidak ada paket sewa disini', 'Tambahkan paket sewa baru dengan pilihan barang dan harga terbaik bagi konsumen Anda sekarang.')
            }

        } catch (error) {
            listPaketLoading.classList.add("d-none");
            toggleListEmpty('show', 'x-circle', 'Gagal memuat daftar paket sewa', 'Coba lagi nanti atau refresh halaman ini.');
            console.error(error);
        }
    }

    function renderListPaket(dataPaket) {
        let a = 0;
        listGroupElement.innerHTML = "";
        Object.keys(dataPaket).forEach(paket => {
            let isi_paket = [];
            for (let i = 0; i < dataPaket[paket].nama_barang.length; i++) {
                isi_paket.push(`${dataPaket[paket].jumlah_barang[i]} ${dataPaket[paket].nama_barang[i]}`);
            }
            listGroupElement.insertAdjacentHTML("beforeend", `
    <div class="col p-0">
    <div class="card m-2 anim-fade shadow-sm border-0">
        <div class="card-body">
            <h3 class="nama mb-1">${dataPaket[paket].nama_paket}</h3>
            <p class="small isi_paket text-muted text-truncate">${isi_paket.join(', ')}</p>
            <p class="d-none last-added">${dataPaket[paket].id_paket}</p>
            <p class="harga lead font-weight-normal mt-3">Rp.${formatRupiah(dataPaket[paket].harga)}</p>
            <div class="d-flex flex-row flex-sm-column mt-4">
                <a href="${BASEURL}/datapaketsewa/details/viewdetail/${dataPaket[paket].id_paket}" class="btn btn-dark m-1 text-truncate">
                    Detail
                </a>
                <div class="dropdown m-1">
                    <a class="btn btn-block btn-outline-dark text-truncate" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        Opsi
                    </a>
                    <div class="dropdown-menu dropdown-menu-right anim-fade shadow border-0">
                        <a href="${BASEURL}/datapaketsewa/details/pageedit/${dataPaket[paket].id_paket}" class="dropdown-item">Edit</a>
                        <a href="" class="dropdown-item text-danger" data-toggle="modal" data-target="#dialogHapus" data-id-paket="${dataPaket[paket].id_paket}" data-nama-paket="${dataPaket[paket].nama_paket}">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>`);

        });

        listGroupElement.querySelectorAll("a[data-toggle=modal]").forEach(btn => {
            btn.addEventListener('click', function () {
                dialogDataElement.forEach(element => {
                    if (element.tagName == "A") element.setAttribute("href", `${BASEURL}/datapaketsewa/hapus/${btn.getAttribute("data-id-paket")}`);
                    else element.textContent = btn.getAttribute("data-nama-paket");
                });
            });
        });
    }

    function toggleListEmpty(toggle, iconName = "", messageTitle = "", messageDetail = "") {
        switch (toggle) {
            case "show":
                listPaketEmptyMessage.classList.replace("d-none", "d-flex");
                listPaketEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#${iconName}`);
                listPaketEmptyMessage.children[1].textContent = messageTitle;
                listPaketEmptyMessage.children[2].textContent = messageDetail;
                break;
            case "hide":
                listPaketEmptyMessage.classList.replace("d-flex", "d-none");
                break;
        }
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListPaket();
    });

    getListPaket();


})