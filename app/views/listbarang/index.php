<section class="col-md mt-3">
    <header class="p-2 bg-white">
        <h2 class="text-center">Daftar Barang</h2>
    </header>
    <main class="mt-3">
        <span class="d-flex mb-3 mx-auto">
            <a class="btn btn-primary mr-3 d-none d-md-flex align-items-center">
                <svg class="bi mr-2" width="24" height="24" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#plus" />
                </svg>
                Tambah
            </a>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-light">
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
                        <button class="dropdown-item sort" data-sort="tgl-mulai" type="button">Tanggal ditambahkan</button>
                        <button class="dropdown-item sort" data-sort="tgl-selesai" type="button">Tanggal selesai</button>
                    </div>
                </div>
                <a type="button" class="text-primary" id="btn-refresh">
                    <svg class="bi" width="18" height="18" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-counterclockwise" />
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

            <div class="list-group">

            </div>

            <div class="blank" style="height: 20vh;"></div>
        </div>

        <button class="btn btn-primary position-fixed rounded-pill shadow-sm d-block d-md-none" style="right: 3vw; bottom: 60px; z-index: 1;" onclick="window.location.href = '#'">
            <svg class="bi" width="36" height="36" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#plus" />
            </svg>
        </button>

    </main>
</section>
<script src="<?= BASEURL ?>/js/barang.min.js"></script>