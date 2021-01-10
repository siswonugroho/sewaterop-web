document.addEventListener('DOMContentLoaded', function (event) {
    const listBarangContainer = document.querySelector("div#list-barang-container");
    const listBarangLoading = listBarangContainer.querySelector("span#loading-list");
    const listBarangEmptyMessage = listBarangContainer.querySelector(".list-barang-empty-message");
    const listGroupElement = listBarangContainer.querySelector("div.list-group");
    const dialogDataElement = document.querySelectorAll(".selected-data");

    function countDataBarang(listParent) {
        const angkaText = document.querySelector("#total-barang");
        angkaText.innerText = listParent.children.length.toString();
    }

    async function getListBarang() {
        try {
            listBarangLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/databarang/getListBarang`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                cache: "default"
            });
            listBarangLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListBarang(responseJson);
            countDataBarang(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                listBarangEmptyMessage.classList.replace("d-flex", "d-none");
                const listBarang = new List('list-barang', {
                    valueNames: ['nama', 'harga', 'stok']
                });
                listBarang.sort('nama', { order: "asc" });
            } else {
                listBarangEmptyMessage.classList.replace("d-none","d-flex");
                listBarangEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#emoji-frown`);
                listBarangEmptyMessage.children[1].textContent = "Tidak ada barang disini.";
                listBarangEmptyMessage.children[2].textContent = "Tambahkan informasi barang yang Anda sewakan dengan mengklik Tambah.";
            }

        } catch (error) {
            listBarangLoading.classList.add("d-none");
            listBarangEmptyMessage.classList.replace("d-none", "d-flex");
            listBarangEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#x-circle`);
            listBarangEmptyMessage.children[1].textContent = "Gagal memuat daftar barang.";
            listBarangEmptyMessage.children[2].textContent = "Coba lagi nanti atau refresh halaman ini.";
            console.error(error);
        }
    }

    function renderListBarang(dataBarang) {
        listGroupElement.innerHTML = "";

        dataBarang.forEach(barang => {
            listGroupElement.insertAdjacentHTML("beforeend", `
            <div class="list-group-item">
                <div class="row anim-fade">
                    <figure class="p-0 my-0 mx-2">
                        <img src="${BASEURL}/resources/img/databarang/${barang.foto_barang}" class="rounded-sm" alt="foto barang" onerror="this.onerror = null; this.src = '${BASEURL}/resources/img/noimg.png'" style="object-fit: cover; height: 100px; width: 100px;">
                    </figure>
                    <div class="col-sm my-3 my-sm-0">
                        <span class="d-flex w-100 justify-content-between">
                            <h3 class="nama">${barang.nama_barang}</h3>
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
                        <p class="font-weight-bold harga">Rp.${formatRupiah(barang.harga)}</p>
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

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListBarang();
    });

    getListBarang();


})