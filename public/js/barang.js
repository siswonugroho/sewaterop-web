document.addEventListener('DOMContentLoaded', function (event) {
    const listBarangContainer = document.querySelector("div#list-barang-container");
    const listBarangLoading = listBarangContainer.querySelector("span#loading-list");
    const listBarangEmptyMessage = listBarangContainer.querySelector(".list-barang-empty-message");
    const listGroupElement = listBarangContainer.querySelector("div.list");
    const dialogDataElement = document.querySelectorAll(".selected-data");

    function countDataBarang(listParent) {
        const angkaText = document.querySelector("#total-barang");
        angkaText.innerText = listParent.children.length.toString();
    }

    async function getListBarang() {
        try {
            listBarangLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/databarang/getListBarang`, {
                method: "GET"
            });
            listBarangLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListBarang(responseJson);
            countDataBarang(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                toggleListEmpty('hide')
                const listBarang = new List('list-barang', {
                    valueNames: ['nama', 'harga', 'stok', 'last-added']
                });
                listBarang.sort('last-added', { order: "desc" });
                listBarang.on('searchComplete', function () {
                    if (listBarang.matchingItems.length === 0) {
                        toggleListEmpty('show', 'search', 'Hasil pencarian tidak ditemukan', 'Coba masukkan kata kunci lain yang lebih umum.')
                    } else {
                        toggleListEmpty('hide');
                    }
                });
            } else {
                toggleListEmpty('show', 'emoji-frown', 'Tidak ada barang disini', 'Tambahkan informasi barang yang Anda sewakan dengan mengklik Tambah.')
            }

        } catch (error) {
            listBarangLoading.classList.add("d-none");
            toggleListEmpty('show', 'x-circle', 'Gagal memuat daftar barang', 'Coba lagi nanti atau refresh halaman ini.')
            console.error(error);
        }
    }

    function renderListBarang(dataBarang) {
        listGroupElement.innerHTML = "";

        dataBarang.forEach(barang => {
            listGroupElement.insertAdjacentHTML("beforeend", `
<div class="col px-0">
    <div class="card m-2 shadow-sm border-0 anim-fade">
        <img src="${BASEURL}/resources/img/databarang/${barang.foto_barang}" class="card-img-top" alt="foto barang" onerror="this.onerror = null; this.src = '${BASEURL}/resources/img/noimg.png'" style="object-fit: cover; height: 10em; width: 100%;">
        <div class="card-body">
            <span class="d-flex w-100 justify-content-between">
                <h5 class="nama text-truncate">${barang.nama_barang}</h5>
                <div class="dropdown p-0">
                    <button class="btn text-primary p-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        <svg class="bi" width="24" height="24" fill="currentColor">
                            <use xlink:href="${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#three-dots" />
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right anim-fade shadow">
                        <a href="${BASEURL}/databarang/pageedit/${barang.id_barang}" class="dropdown-item">Edit</a>
                        <a href="" class="dropdown-item text-danger" data-toggle="modal" data-target="#dialogHapus" data-id-barang="${barang.id_barang}" data-nama-barang="${barang.nama_barang}">Hapus</a>
                    </div>
                </div>
            </span>
            <p class="font-weight-bold">Rp.${formatRupiah(barang.harga)}</p>
            <p class="d-none harga">Rp.${barang.harga}</p>
            <p class="d-none last-added">Rp.${barang.id_barang}</p>
            <p class="text-muted my-0 stok">Stok: ${barang.stok}</p>
        </div>
    </div>
</div>`);
        });

        listGroupElement.querySelectorAll("a[data-toggle=modal]").forEach(btn => {
            btn.addEventListener('click', function () {
                dialogDataElement.forEach(element => {
                    if (element.tagName == "A") element.setAttribute("href", `${BASEURL}/databarang/hapus/${btn.getAttribute("data-id-barang")}`);
                    else element.textContent = btn.getAttribute("data-nama-barang");
                });
            });
        });
    }

    function toggleListEmpty(toggle, iconName = "", messageTitle = "", messageDetail = "") {
        switch (toggle) {
            case "show":
                listBarangEmptyMessage.classList.replace("d-none", "d-flex");
                listBarangEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#${iconName}`);
                listBarangEmptyMessage.children[1].textContent = messageTitle;
                listBarangEmptyMessage.children[2].textContent = messageDetail;
                break;
            case "hide":
                listBarangEmptyMessage.classList.replace("d-flex", "d-none");
                break;
        }
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListBarang();
    });

    getListBarang();


})