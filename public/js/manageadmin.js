document.addEventListener('DOMContentLoaded', function (event) {
    const listAdminContainer = document.querySelector("div#list-admin-container");
    const listAdminLoading = listAdminContainer.querySelector("span#loading-list");
    const listAdminEmptyMessage = listAdminContainer.querySelector(".list-admin-empty-message");
    const listGroupElement = listAdminContainer.querySelector("div.list-group");
    const dialogDataElement = document.querySelectorAll(".selected-data");
    const angkaText = document.querySelector("#total-admin");
    const totalPendingText = document.querySelector("#total-pending");

    function countDataAdmin(listParent) {
        angkaText.textContent = listParent.children.length.toString();
        totalPendingText.textContent = listGroupElement.querySelectorAll('a.approve-admin').length.toString();
    }

    async function getListAdmin() {
        try {
            listAdminLoading.classList.remove("d-none");
            const response = await fetch(`${BASEURL}/dataadmin/getListAdmin`);
            listAdminLoading.classList.add("d-none");
            if (!response.ok) throw Error();
            const responseJson = await response.json();
            if (!responseJson) throw Error();
            renderListAdmin(responseJson);
            countDataAdmin(listGroupElement);
            if (Object.keys(responseJson).length !== 0) {
                toggleListEmpty('hide');
                const listAdmin = new List('list-admin', {
                    valueNames: ['nama', 'last-added', 'status']
                });
                listAdmin.sort('status', { order: "desc" });
                listAdmin.on('searchComplete', function () {
                    if (listAdmin.matchingItems.length === 0) {
                        toggleListEmpty('show', 'search', 'Hasil pencarian tidak ditemukan', 'Coba masukkan kata kunci lain yang lebih umum.');
                    } else {
                        toggleListEmpty('hide');
                    }
                });
            } else {
                toggleListEmpty('show', 'emoji-frown', 'Tidak ada admin disini', 'Admin yang baru mendaftar akan muncul disini.');
            }

        } catch (error) {
            listAdminLoading.classList.add("d-none");
            toggleListEmpty('show', 'x-circle', 'Gagal memuat daftar admin', 'Coba lagi nanti atau refresh halaman ini.');
            console.error(error);
        }
    }

    function renderListAdmin(dataAdmin) {
        listGroupElement.innerHTML = "";

        dataAdmin.forEach(admin => {
            let badgeStatus = '';
            let btnApproveDisplay = '';
            if (admin.status_user === 'pending') {
                badgeStatus = `<p class="badge badge-warning p-1 my-1 status">${admin.status_user}</p>`;
                btnApproveDisplay = `<a href="${BASEURL}/dataadmin/approveadmin/${admin.id_admin}" class="btn btn-primary my-1 approve-admin" data-id-admin="${admin.id_admin}" data-nama-admin="${admin.nama_admin}">Setujui</a>`;
            } else if (admin.status_user === 'admin') {
                badgeStatus = `<p class="badge badge-success p-1 my-1 status">${admin.status_user}</p>`;
            }
            listGroupElement.insertAdjacentHTML("beforeend", `
<div class="list-group-item anim-fade">
    <div class="row">
    <div class="col-12 col-lg-8">
    <h5 class="nama">${admin.nama_admin}</h5>
    ${badgeStatus}
    <p class="d-none last-added">${admin.id_admin}</p>
    </div>
    <div class="col-md my-2">
    ${btnApproveDisplay}
    <button class="btn btn-danger my-1" data-toggle="modal" data-target="#dialogHapus" data-id-admin="${admin.id_admin}" data-nama-admin="${admin.nama_admin}">Hapus</button><br>
    </div>
    </div>
</div>`);

        });

        listGroupElement.querySelectorAll("button[data-toggle=modal]").forEach(btn => {
            btn.addEventListener('click', function () {
                dialogDataElement.forEach(element => {
                    if (element.tagName == "A") element.setAttribute("href", `${BASEURL}/dataadmin/hapus/${btn.getAttribute("data-id-admin")}`);
                    else element.textContent = btn.getAttribute("data-nama-admin");
                });
            });
        });
    }

    function toggleListEmpty(toggle, iconName = "", messageTitle = "", messageDetail = "") {
        switch (toggle) {
            case "show":
                listAdminEmptyMessage.classList.replace("d-none", "d-flex");
                listAdminEmptyMessage.children[0].querySelector("use").setAttribute("href", `${BASEURL}/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#${iconName}`);
                listAdminEmptyMessage.children[1].textContent = messageTitle;
                listAdminEmptyMessage.children[2].textContent = messageDetail;
                break;
            case "hide":
                listAdminEmptyMessage.classList.replace("d-flex", "d-none");
                break;
        }
    }

    document.querySelector("a#btn-refresh").addEventListener('click', function () {
        getListAdmin();
    });

    getListAdmin();


})