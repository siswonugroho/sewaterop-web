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
                toggleListEmpty('hide');
                const listPenyewa = new List('list-penyewa', {
                    valueNames: ['nama', 'alamat', 'username', 'last-added']
                });
                listPenyewa.sort('last-added', { order: "desc" });
                listPenyewa.on('searchComplete', function () {
                    if (listPenyewa.matchingItems.length === 0) {
                        toggleListEmpty('show', 'search', 'Hasil pencarian tidak ditemukan', 'Coba masukkan kata kunci lain yang lebih umum.');
                    } else {
                        toggleListEmpty('hide');
                    }
                });
            } else {
                toggleListEmpty('show', 'emoji-frown', 'Tidak ada penyewa disini', 'Sebelum membuat pesanan, tambahkan penyewa terlebih dahulu');
            }

        } catch (error) {
            listPenyewaLoading.classList.add("d-none");
            toggleListEmpty('show', 'x-circle', 'Gagal memuat daftar penyewa', 'Coba lagi nanti atau refresh halaman ini.');
            console.error(error);
        }
    }

    function renderListPenyewa(dataPenyewa) {
        listGroupElement.innerHTML = "";

        dataPenyewa.forEach(penyewa => {
            listGroupElement.insertAdjacentHTML("beforeend", `
<div class="list-group-item anim-fade">
    <span class="d-flex w-100 justify-content-between">
        <h5 class="nama">${penyewa.nama_pemesan}</h5>
        <div class="dropdown p-0">
            <button class="btn text-primary p-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <svg class="bi" width="24" height="24" fill="currentColor">
                    <use href="${BASEURL}/assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#three-dots" />
                </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-right anim-fade shadow">
                <a href="${BASEURL}/datapenyewa/pageedit/${penyewa.id_pemesan}" class="dropdown-item">Edit</a>
                <a href="" class="dropdown-item text-danger" data-toggle="modal" data-target="#dialogHapus" data-id-penyewa="${penyewa.id_pemesan}" data-nama-penyewa="${penyewa.nama_pemesan}">Hapus</a>
            </div>
        </div>
    </span>
    <p class="text-muted my-0 username">@${penyewa.username} • ${penyewa.telepon}</p>
    <p class="text-muted my-0 alamat">${penyewa.alamat}</p>
    <p class="d-none last-added">${penyewa.id_pemesan}</p>
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

    function toggleListEmpty(toggle, iconName = "", messageTitle = "", messageDetail = "") {
        switch (toggle) {
            case "show":
                listPenyewaEmptyMessage.classList.replace("d-none", "d-flex");
                listPenyewaEmptyMessage.children[0].querySelector("use").setAttribute("href", `${BASEURL}/assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#${iconName}`);
                listPenyewaEmptyMessage.children[1].textContent = messageTitle;
                listPenyewaEmptyMessage.children[2].textContent = messageDetail;
                break;
            case "hide":
                listPenyewaEmptyMessage.classList.replace("d-flex", "d-none");
                break;
        }
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListPenyewa();
    });

    getListPenyewa();


})