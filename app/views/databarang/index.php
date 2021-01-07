<section class="col-md mt-3">
    <header class="p-2 bg-white">
        <h2 class="text-center">Daftar Barang</h2>
        <?php Flasher::showFlash(); ?>
    </header>
    <main id="list-barang">
        <span class="d-flex py-3 mx-auto sticky-top bg-white">
            <a class="btn btn-primary mr-3 d-none d-md-flex align-items-center" href="<?= BASEURL ?>/databarang/pagetambah">
                <svg class="bi mr-2" width="24" height="24" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#plus" />
                </svg>
                Tambah
            </a>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-light border-right-0">
                        <svg class="bi text-secondary" width="16" height="16" fill="currentColor">
                            <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#search" />
                        </svg>
                    </div>
                </div>
                <input type="search" class="search form-control border-left-0 bg-light" placeholder="Cari barang" aria-label="Barang">
            </div>
        </span>

        <div class="d-flex justify-content-between">
            <p>Total <strong id="total-barang">0</strong> barang</p>
            <span>
                <div class="btn-group mx-3">
                    <a type="button" class="text-primary dropdown-toggle text-decoration-none" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#filter" />
                        </svg>
                        <p class="d-none d-sm-inline">Urutkan</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow">
                        <button class="dropdown-item sort" data-sort="nama" type="button">Nama</button>
                        <button class="dropdown-item sort" data-sort="harga" type="button">Harga</button>
                        <button class="dropdown-item sort" data-sort="stok" type="button">Stok</button>
                    </div>
                </div>
                <a type="button" class="text-primary" id="btn-refresh">
                    <svg class="bi" width="18" height="18" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-clockwise" />
                    </svg>
                    <p class="d-none d-sm-inline">Refresh</p>
                </a>
            </span>
        </div>

        <div id="list-barang-container">
            <div class="d-none flex-column text-center align-items-center my-5" id="no-data">
                <p class="display-4 text-secondary">Tidak ada barang</p>
                <p class="lead text-secondary font-weight-normal">Tambahkan barang baru dengan mengklik tombol Tambah</p>
            </div>

            <span class="row my-5" id="loading-list">
                <div class="spinner-border text-primary mx-auto" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </span>

            <div class="list-group list">

            </div>

            <div class="blank" style="height: 20vh;"></div>
        </div>

        <button class="btn btn-primary position-fixed rounded-pill shadow-sm p-2 d-block d-md-none" style="right: 3vw; bottom: 60px; z-index: 1;" onclick="window.location.href = `${BASEURL}/databarang/pagetambah`">
            <svg class="bi" width="36" height="36" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#plus" />
            </svg>
        </button>

    </main>
</section>

<div class="modal fade" id="dialogHapus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="hapusTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-transparent border-0">
                <h5 class="modal-title" id="hapusTitle">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus "<span class="selected-data"></span>" dari daftar barang?</p>
            </div>
            <div class="modal-footer bg-transparent border-0">
                <a data-dismiss="modal" class="btn text-danger">Batal</a>
                <a href="" class="btn btn-danger selected-data">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/list.min.js"></script>
<script src="<?= BASEURL ?>/js/barang.min.js"></script>