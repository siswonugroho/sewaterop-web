<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Detail</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col p-0">
                <div class="card m-2 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">ID paket</span>
                            <p class="col font-weight-bold"><?= strtoupper($data['formvalue']['id_paket']) ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">Nama paket</span>
                            <p class="col font-weight-bold"><?= $data['formvalue']['nama_paket'] ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">Harga</span>
                            <p class="col font-weight-bold harga"><?= $data['formvalue']['harga'] ?></p>
                        </div>
                        <div class="m-1">
                            <a href="<?= BASEURL ?>/datapaketsewa/details/pageedit/<?= $data['formvalue']['id_paket'] ?>" class="btn btn-primary">
                                <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#pencil-fill" />
                                </svg>
                                Edit
                            </a>
                            <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dialogHapus">
                                <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#trash" />
                                </svg>
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col p-0">
                <div class="card m-2 border-0 shadow-sm">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="m-0">Isi Paket</h5>
                        </li>
                        <?php foreach ($data['formvalue']['id_barang'] as $key => $value) : ?>
                        <li class="list-group-item">
                            <img src="<?= BASEURL ?>/resources/img/databarang/<?= $data['formvalue']['foto_barang'][$key]['foto_barang'] ?>" class="rounded-sm mr-2" alt="foto barang" onerror="this.onerror = null; this.src = '<?= BASEURL ?>/resources/img/noimg.png'" style="width:3em; height: 3em; object-fit: cover; ">
                            <?= $data['formvalue']['jumlah_barang'][$key] . ' ' . $data['formvalue']['nama_barang'][$key] ?>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <div style="height: 15vh;"></div>
</section>

<div class="modal fade" id="dialogHapus" data-keyboard="false" tabindex="-1" aria-labelledby="hapusTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-transparent border-0">
                <h5 class="modal-title" id="hapusTitle">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus "<?= $data['formvalue']['nama_paket'] ?>" dari daftar paket sewa?</p>
            </div>
            <div class="modal-footer bg-transparent border-0">
                <a data-dismiss="modal" class="btn text-danger">Batal</a>
                <a href="<?= BASEURL ?>/datapaketsewa/hapus/<?= $data['formvalue']['id_paket'] ?>" class="btn btn-danger selected-data">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/formatRupiah.min.js"></script>
<script>
    const txtHarga = document.querySelector("p.harga");
    txtHarga.textContent = `Rp.${formatRupiah(txtHarga.textContent)}`;
</script>