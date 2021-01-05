document.addEventListener('DOMContentLoaded', function (event) {
    const listBarangContainer = document.querySelector("div#list-barang-container");
    const listBarangEmptyText = listBarangContainer.querySelector("div#no-data");
    const listBarangLoading = listBarangContainer.querySelector("span#loading-list");
    const listGroupElement = listBarangContainer.querySelector("div.list-group");

    function countDataBarang(parentElement) {
        const angkaText = document.querySelector("#total-barang");
        angkaText.innerText = parentElement.children.length.toString();
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
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) listBarangEmptyText.classList.replace("d-none", "d-flex");
            else listBarangEmptyText.classList.replace("d-flex", "d-none");
            listBarangLoading.classList.add("d-none");

            renderListBarang(responseJson);
            
        } catch (error) {

        }
    }

    function renderListBarang(dataBarang) {
        listGroupElement.innerHTML = "";

        dataBarang.forEach(barang => {
            listGroupElement.innerHTML += `<a class="list-group-item list-group-item-action">
            <div class="row">
                <figure class="col-2 p-0 my-0 mx-2 d-flex justify-content-center">
                    <img src="${barang.foto_barang}" alt="foto barang" onerror="this.onerror = null; this.src = 'resources/img/noimg.png'" class="img-fluid">
                </figure>
                <div class="col-sm my-3 my-sm-0">
                    <span class="d-flex w-100 justify-content-between">
                        <h3>${barang.nama_barang}</h3>
                        <div class="btn-group p-0">
                            <button class="btn text-primary p-1" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                <svg class="bi" width="24" height="24" fill="currentColor">
                                    <use xlink:href="${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#three-dots" />
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <button class="dropdown-item" type="button">Edit</button>
                                <button class="dropdown-item text-danger" type="button">Hapus</button>
                            </div>
                        </div>
                    </span>
                    <p class="font-weight-bold">Rp.${formatRupiah(barang.harga)}</p>
                    <p class="text-muted my-0">Stok: ${barang.stok}</p>
                </div>
            </div>
        </a>`;
        });
        countDataBarang(listGroupElement);
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function(){
        getListBarang();
    })

    getListBarang();
})