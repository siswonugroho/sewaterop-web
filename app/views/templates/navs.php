    <aside class="bg-light col-md-3 d-none d-md-block py-3 px-0 vh-100 border-right sticky-top" data-title="<?= $data['nav-link'] ?>" role="navigation">
        <div class="row mb-3">
            <a href="<?= BASEURL ?>" class="mx-auto">
                <img src="<?= BASEURL ?>/img/sewaterop-logo.svg" alt="Logo sewaterop" height="64">
            </a>
        </div>
        <div class="nav mb-3 mx-2 flex-column">
            <a class="nav-link text-secondary py-3" id="dashboard-link" href="#pills-home">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#house" />
                </svg>
                Home
            </a>
            <a class="nav-link text-secondary py-3" id="sewaan-link" href="#pills-profile">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#card-list" />
                </svg>
                Sewaan
            </a>
            <a class="nav-link text-secondary py-3" id="barang-link" href="#pills-contact">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#archive" />
                </svg>
                Barang
            </a>
            <a class="nav-link text-secondary py-3" id="barang-link" href="#pills-contact">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#clock-history" />
                </svg>
                Riwayat
            </a>
        </div>
    </aside>
    <nav class="navbar bg-light p-0 border-top fixed-bottom d-block d-md-none navbar-expand" data-title="<?= $data['nav-link'] ?>">
        <div class="nav nav-justified">
                <a class="nav-link text-secondary d-flex flex-column align-items-center">
                    <svg class="bi mx-auto" width="24" height="24" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#house" />
                    </svg>
                    <small class="text-center">Home</small>
                </a>
                <a class="nav-link text-secondary d-flex flex-column align-items-center">
                    <svg class="bi mx-auto" width="24" height="24" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#card-list" />
                    </svg>
                    <small class="text-center">Sewaan</small>
                </a>
                <a class="nav-link text-secondary d-flex flex-column align-items-center">
                    <svg class="bi mx-auto" width="24" height="24" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#archive" />
                    </svg>
                    <small class="text-center">Barang</small>
                </a>
                <a class="nav-link text-secondary d-flex flex-column align-items-center">
                    <svg class="bi mx-auto" width="24" height="24" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#clock-history" />
                    </svg>
                    <small class="text-center">Riwayat</small>
                </a>
                <a class="nav-link text-secondary d-flex flex-column align-items-center">
                    <svg class="bi mx-auto" width="24" height="24" fill="currentColor">
                        <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#person-circle" />
                    </svg>
                    <small class="text-center">Akun</small>
                </a>
        </div>
    </nav>