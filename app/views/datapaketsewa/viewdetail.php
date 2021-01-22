<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <!-- <h2 class="text-center mx-4 my-0 text-truncate">Detail</h2> -->
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <h2 class="display-4 font-weight-normal"><?= $data['formvalue']['nama_paket'] ?></h2>
        <p class="harga lead font-weight-normal"><?= $data['formvalue']['harga'] ?></p>
        <div class="d-flex">
            <a href="<?= BASEURL ?>/datapaketsewa/details/pageedit/<?= $data['formvalue']['id_paket'] ?>" class="btn btn-lg btn-primary m-1">
                <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#pencil-fill" />
                </svg>
                Edit
            </a>
            <a class="btn btn-lg btn-danger m-1" data-toggle="modal" data-target="#dialogHapus">
                <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#trash-fill" />
                </svg>
                Hapus
            </a>
        </div>
        <div class="mt-5">
            <h4>Termasuk dalam paket ini</h4>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 m-0">
                <?php foreach ($data['formvalue']['id_barang'] as $key => $value) : ?>
                    <div class="col p-0">
                        <div class="card mx-0 mx-sm-2 my-2 shadow-sm border-0">
                        <img src="<?= BASEURL ?>/resources/img/databarang/<?= $data['formvalue']['foto_barang'][$key]['foto_barang'] ?>" class="card-img-top" alt="foto barang" onerror="this.onerror = null; this.src = '<?= BASEURL ?>/resources/img/noimg.png'" style="width:100%; height: 10em; object-fit: cover; ">
                            <div class="card-body m-0">
                                <h2 class="font-weight-bold"><?= $data['formvalue']['jumlah_barang'][$key] ?></h2>
                                <p class="lead font-weight-normal"><?= $data['formvalue']['nama_barang'][$key] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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