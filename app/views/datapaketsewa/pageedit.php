<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Edit Paket Sewa</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <form action="<?= BASEURL ?>/datapaketsewa/edit" method="post">
            <div class="row">
                <div class="col-sm">
                    <input type="hidden" name="paket[id_paket]" id="id_paket" value="<?= $data['formvalue']['id_paket'] ?>">
                    <div class="form-group">
                        <label for="nama_barang">Nama Paket Sewa</label>
                        <input type="text" class="form-control" name="paket[nama_paket]" id="nama_paket" value="<?= $data['formvalue']['nama_paket'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga (Rp)</label>
                        <input type="number" class="form-control" name="paket[harga]" id="harga" value="<?= $data['formvalue']['harga'] ?>" placeholder="Misal: 10000">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group list-barang">
                        <label for="nama_barang">Isi paket</label>


                        <?php foreach ($data['formvalue']['id_barang'] as $key => $value) : ?>
                            <div class="input-group list-item">
                                <input type="number" readonly name="paket[jumlah_barang][]" class="form-control bg-white jumlah" value="<?= $data['formvalue']['jumlah_barang'][$key] ?>">
                                <input type="hidden" name="paket[id_barang][]" class="form-control bg-white jumlah" value="<?= $data['formvalue']['id_barang'][$key] ?>">
                                <input type="text" readonly name="paket[nama_barang][]" class="form-control bg-white w-50 nama" value="<?= $data['formvalue']['nama_barang'][$key] ?>">
                                <div class="input-group-append remove-btn">
                                    <a href="javascript:void(0)" class="text-decoration-none input-group-text">
                                        <svg class="bi" width="20" height="20" fill="currentColor">
                                            <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#x" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                    <a class="btn btn-outline-primary" data-toggle="modal" data-target="#pilih-barang">Tambah barang</a>
                </div>
            </div>
            </div>

            <button type="submit" class="btn btn-lg btn-primary my-3">
                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#check2" />
                </svg>
                Simpan
            </button>
        </form>
    </main>
    <div style="height: 15vh;"></div>
</section>

<div class="modal fade" id="pilih-barang" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="modal-header">
                <h3 class="modal-title">Pilih barang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </span>
            <div class="modal-body">
                <span class="row my-3" id="loading-list">
                    <div class="spinner-border text-primary mx-auto" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </span>
            </div>
            <div class="modal-footer">
                <div class="form-inline">
                    <label for="pilihJumlah">Jumlah:</label>
                    <input type="number" class="form-control form-control-sm  mx-1" name="jumlah" value="0" id="pilihJumlah">
                </div>
                <a class="btn btn-primary" data-dismiss="modal" id="tambahItem">Tambah</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/paketsewa-pagetambah.min.js"></script>