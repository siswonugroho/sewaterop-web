<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left'); ?>" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Detail</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col p-0">
                <div class="card m-2 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="h2"><?= $formvalue['nama_pemesan'] ?></p>
                        <p class="text-muted mb-1">ID Sewaan <strong><?= strtoupper($formvalue['id_pesanan']) ?></strong></p>
                        <div class="my-2">
                            <p class="m-0">Tanggal sewa: <span class="font-weight-bold tgl-text"><?= $formvalue['tgl_mulai'] ?> <?= $formvalue['waktu_mulai'] ?></span></p>
                            <p class="m-0">Tanggal berakhir: <span class="font-weight-bold tgl-text"><?= $formvalue['tgl_selesai'] ?> <?= $formvalue['waktu_selesai'] ?></span></p>
                        </div>
                        <hr>
                        <div class="row align-items-center mx-1 my-2">
                            <svg class="bi mr-2 text-primary" width="18" height="18" fill="currentColor">
                                <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#geo-alt'); ?>" />
                            </svg>
                            <span class="col"><?= $formvalue['alamat'] ?></span>
                        </div>
                        <div class="row align-items-center mx-1 my-2">
                            <svg class="bi mr-2 text-primary" width="18" height="18" fill="currentColor">
                                <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#telephone'); ?>" />
                            </svg>
                            <span class="col"><?= $formvalue['telepon'] ?></span>
                        </div>
                        <div class="mx-1 mt-4">
                            <a href="<?= base_url('datasewaan/details/pageedit/') . $formvalue['id_pesanan'] ?>" class="btn btn-primary" title="Edit">
                                <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                                    <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#pencil'); ?>" />
                                </svg>
                                <span>Edit</span>
                            </a>
                            <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dialogHapus" title="Hapus sewa ini">
                                <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                                    <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#trash'); ?>" />
                                </svg>
                                <span>Hapus</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col p-0">
                <div class="card m-2 border-0 shadow-sm">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?php if (startsWith($formvalue['id_paket'], 'sw')) : ?>
                                <h5 class="m-0">Barang yang disewa</h5>
                            <?php else : ?>
                                <span class="d-flex">
                                    <svg class="bi text-secondary mr-3" width="24" height="24" fill="currentColor">
                                        <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#gift'); ?>" />
                                    </svg>
                                    <h5 class="m-0">Paket sewa <?= $formvalue['nama_paket'] ?></h5>
                                </span>

                            <?php endif ?>
                        </li>
                        <?php foreach ($formvalue['barang_sewaan']['nama_barang'] as $key => $value) : ?>
                            <li class="list-group-item">
                                <img src="<?= base_url('assets/resources/img/databarang/') . $formvalue['barang_sewaan']['foto_barang'][$key] ?>" class="rounded-sm mr-2" alt="foto barang" onerror="this.onerror = null; this.src = '<?= base_url('assets/resources/img/noimg.png') ?>'" style="width:3em; height: 3em; object-fit: cover; ">
                                <?= $formvalue['barang_sewaan']['jumlah_barang'][$key] . ' ' . $formvalue['barang_sewaan']['nama_barang'][$key] ?>
                            </li>
                        <?php endforeach ?>
                        <li class="list-group-item d-flex">
                            <div class="flex-grow-1">
                                <span>Total biaya:</span>
                                <p class="lead font-weight-bold m-0">Rp. <?= formatRupiah($formvalue['harga']) ?></p>
                            </div>
                            <a href="<?= base_url('datasewaan/details/checkout/') . $formvalue['id_pesanan'] ?>" class="btn btn-success my-3">
                                <svg class="bi mr-2 d-none d-sm-inline" width="18" height="18" fill="currentColor">
                                    <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#credit-card'); ?>" />
                                </svg>
                                Bayar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="white-space" style="height: 20vh;"></div>
    </main>
</section>

<div class="modal fade" id="dialogHapus" data-keyboard="false" tabindex="-1" aria-labelledby="hapusTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-transparent border-0">
                <h5 class="modal-title" id="hapusTitle">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus sewaan dengan ID "<?= $formvalue['id_pesanan'] ?>" dari daftar sewaan?</p>
            </div>
            <div class="modal-footer bg-transparent border-0">
                <a data-dismiss="modal" class="btn text-danger">Batal</a>
                <a href="<?= base_url('datasewaan/hapus/') . $formvalue['id_pesanan'] ?>" class="btn btn-danger selected-data">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/luxon.min.js') ?>"></script>
<script src="<?= base_url('assets/js/formatTglText.js') ?>"></script>