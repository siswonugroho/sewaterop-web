<section class="col-md mt-3">
    <header class="p-2 bg-white">
        <h2 class="text-center">Riwayat Sewaan</h2>
    </header>
    <main id="list-riwayat">
        <?php Flasher::showFlash(); ?>
        <span class="d-flex py-3 justify-content-center sticky-top bg-white">
            <div class="input-group mx-0 mx-md-5">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-light border-right-0">
                        <svg class="bi text-secondary" width="16" height="16" fill="currentColor">
                            <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#search" />
                        </svg>
                    </div>
                </div>
                <input type="search" class="search form-control border-left-0 bg-light" placeholder="Cari riwayat" aria-label="Riwayat">
            </div>

        </span>

        <div class="d-flex justify-content-between">
            <p>Total <strong id="total-riwayat">0</strong> riwayat</p>
            <span class="btn-group mb-2">
                <div class="btn-group">
                    <a type="button" class="btn btn-sm btn-outline-primary dropdown-toggle text-decoration-none" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        <svg class="bi" width="18" height="18" fill="currentColor">
                            <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#filter" />
                        </svg>
                        <p class="d-none d-sm-inline">Urutkan</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right anim-fade shadow">
                        <button class="dropdown-item sort" data-sort="nama" type="button">Nama</button>
                        <button class="dropdown-item sort" data-sort="last-added" type="button">Terakhir ditambahkan</button>
                    </div>
                </div>
                <a type="button" class="btn btn-sm btn-outline-primary" id="btn-refresh">
                    <svg class="bi" width="18" height="18" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-clockwise" />
                    </svg>
                    <p class="d-none d-sm-inline">Refresh</p>
                </a>
            </span>
        </div>
        <div class="form-inline mb-2">
            <div class="custom-control custom-checkbox">
                <?php if ($data['is-blm-lunas']) : ?>
                    <input type="checkbox" checked class="custom-control-input" id="filter-blm-lunas">
                <?php else : ?>
                    <input type="checkbox" class="custom-control-input" id="filter-blm-lunas">
                <?php endif ?>
                <label class="custom-control-label" for="filter-blm-lunas">Hanya tampilkan yang belum lunas</label>
            </div>
        </div>
        <div id="list-riwayat-container">

            <span class="row my-5" id="loading-list">
                <div class="spinner-border text-primary mx-auto" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </span>
            <div class="d-flex flex-column text-secondary text-center align-items-center my-5 list-riwayat-empty-message" id="no-data">
                <svg class="bi my-3" width="36" height="36" fill="currentColor">
                    <use xlink:href="" />
                </svg>
                <p class="h4"></p>
                <p class="font-weight-normal"></p>
            </div>

            <div class="list-group list">
                <!-- List riwayat berada disini -->
            </div>

            <div class="white-space" style="height: 20vh;"></div>
        </div>

    </main>
</section>

<div class="modal fade" id="dialogHapus" data-keyboard="false" tabindex="-1" aria-labelledby="hapusTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-transparent border-0">
                <h5 class="modal-title" id="hapusTitle">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus "<span class="selected-data"></span>" dari daftar riwayat?</p>
            </div>
            <div class="modal-footer bg-transparent border-0">
                <a data-dismiss="modal" class="btn text-danger">Batal</a>
                <a href="" class="btn btn-danger selected-data">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/list.min.js"></script>
<script src="<?= BASEURL ?>/js/luxon.min.js"></script>
<script src="<?= BASEURL ?>/js/riwayat.min.js"></script>