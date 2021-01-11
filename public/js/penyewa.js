document.addEventListener('DOMContentLoaded', function (event) {
    const listPenyewaContainer = document.querySelector("div#list-penyewa-container");
    const listPenyewaLoading = listPenyewaContainer.querySelector("span#loading-list");
    const listPenyewaEmptyMessage = listPenyewaContainer.querySelector(".list-penyewa-empty-message");
    const listGroupElement = listPenyewaContainer.querySelector("div.list-group");
    const dialogDataElement = document.querySelectorAll(".selected-data");

    function countDataPenyewa(listParent) {
        const angkaText = document.querySelector("#total-penyewa");
        angkaText.innerText = listParent.children.length.toString();
    }

    async function getListPenyewa() {
        try {
            listPenyewaLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/datapenyewa/getListPenyewa`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                cache: "default"
            });
            listPenyewaLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListPenyewa(responseJson);
            countDataPenyewa(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                listPenyewaEmptyMessage.classList.replace("d-flex", "d-none");
                const listPenyewa = new List('list-penyewa', {
                    valueNames: ['nama', 'alamat', 'telepon']
                });
                listPenyewa.sort('nama', { order: "asc" });
            } else {
                listPenyewaEmptyMessage.classList.replace("d-none", "d-flex");
                listPenyewaEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#emoji-frown`);
                listPenyewaEmptyMessage.children[1].textContent = "Tidak ada penyewa disini.";
                listPenyewaEmptyMessage.children[2].textContent = "Tambahkan penyewa baru sebelum membuat pesanan sewa.";
            }

        } catch (error) {
            listPenyewaLoading.classList.add("d-none");
            listPenyewaEmptyMessage.classList.replace("d-none", "d-flex");
            listPenyewaEmptyMessage.children[0].querySelector("use").setAttribute("xlink:href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#x-circle`);
            listPenyewaEmptyMessage.children[1].textContent = "Gagal memuat daftar penyewa.";
            listPenyewaEmptyMessage.children[2].textContent = "Coba lagi nanti atau refresh halaman ini.";
            console.error(error);
        }
    }

    function renderListPenyewa(dataPenyewa) {
        listGroupElement.innerHTML = "";

        dataPenyewa.forEach(penyewa => {
            listGroupElement.insertAdjacentHTML("beforeend", `
<div class="list-group-item anim-fade">
    <span class="d-flex w-100 justify-content-between">
        <h3 class="nama">${penyewa.nama_pemesan}</h3>
        <div class="dropdown p-0">
            <button class="btn text-primary p-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <svg class="bi" width="24" height="24" fill="currentColor">
                    <use xlink:href="${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#three-dots" />
                </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-right anim-fade shadow">
                <a href="${BASEURL}/datapenyewa/pageedit/${penyewa.id_pemesan}" class="dropdown-item">Edit</a>
                <a href="" class="dropdown-item text-danger" data-toggle="modal" data-target="#dialogHapus" data-id-penyewa="${penyewa.id_pemesan}" data-nama-penyewa="${penyewa.nama_pemesan}">Hapus</a>
            </div>
        </div>
    </span>
    <p class="text-muted my-0 alamat">${penyewa.alamat}</p>
    <p class="text-muted my-0 telepon">${penyewa.telepon}</p>
</div>`);
        });

        listGroupElement.querySelectorAll("a[data-toggle=modal]").forEach(btn => {
            btn.addEventListener('click', function () {
                dialogDataElement.forEach(element => {
                    if (element.tagName == "A") element.setAttribute("href", `${BASEURL}/datapenyewa/hapus/${btn.getAttribute("data-id-penyewa")}`);
                    else element.textContent = btn.getAttribute("data-nama-penyewa");
                });
            });
        });
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListPenyewa();
    });

    getListPenyewa();


})