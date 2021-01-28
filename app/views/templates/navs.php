    <aside class="bg-light col-3 d-none d-md-block py-3 px-0 vh-100 shadow-sm sticky-top" data-title="<?= $data['nav-link'] ?>" role="navigation">
        <div class="text-center mb-3">
            <a href="<?= BASEURL ?>" class="mx-auto">
                <img src="<?= BASEURL ?>/img/sewaterop-logo.svg" alt="Logo sewaterop" height="64">
            </a>
        </div>
        <div class="nav mb-3 mx-2 d-flex flex-column">
            <a class="nav-link text-secondary py-2" id="dashboard-link" href="<?= BASEURL ?>/home">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#house" />
                </svg>
                Home
            </a>
            <a class="nav-link text-secondary py-2" id="sewaan-link" href="<?= BASEURL ?>/datasewaan">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#card-list" />
                </svg>
                Sewaan
            </a>
            <a class="nav-link text-secondary py-2" id="sewaan-link" href="<?= BASEURL ?>/datapenyewa">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#person-check" />
                </svg>
                Penyewa
            </a>
            <a class="nav-link text-secondary py-2" id="barang-link" href="<?= BASEURL ?>/databarang">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#archive" />
                </svg>
                Barang
            </a>
            <a class="nav-link text-secondary py-2" id="barang-link" href="<?= BASEURL ?>/datapaketsewa">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#gift" />
                </svg>
                Paket Sewa
            </a>
            <a class="nav-link text-secondary py-2" id="barang-link" href="<?= BASEURL ?>/datariwayat">
                <svg class="bi mr-3" width="24" height="24" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#clock-history" />
                </svg>
                Riwayat
            </a>
            <hr>
            <div class="dropdown px-2 w-100">
                <a href="javascript:void(0)" hreflang="Open menu" class="dropdown-toggle d-flex align-items-center" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    <svg class="bi mr-2 text-muted" width="24" height="24" fill="currentColor">
                        <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#person-circle" />
                    </svg>
                    <span class="text-dark text-truncate font-weight-bold"><?= $_SESSION['nama_admin'] ?></span>
                </a>
                <div class="dropdown-menu anim-fade shadow">
                    <a href="<?= BASEURL; ?>/editakun/changeuserinfo" class="dropdown-item">Edit profil</a>
                    <a href="<?= BASEURL; ?>/logout" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
    </aside>
    <nav class="navbar bg-light border-top shadow-sm fixed-bottom d-block d-md-none navbar-expand py-0" data-title="<?= $data['nav-link'] ?>">
        <div class="nav justify-content-around">
            <a class="nav-link text-secondary d-flex flex-column p-1 align-items-center" href="<?= BASEURL ?>/home">
                <svg class="bi mx-auto" width="18" height="18" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#house" />
                </svg>
                <small class="text-center">Home</small>
            </a>
            <a class="nav-link text-secondary d-flex flex-column p-1 align-items-center" href="<?= BASEURL ?>/datasewaan">
                <svg class="bi mx-auto" width="18" height="18" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#card-list" />
                </svg>
                <small class="text-center">Sewaan</small>
            </a>
            <a class="nav-link text-secondary d-flex flex-column p-1 align-items-center" href="<?= BASEURL ?>/databarang">
                <svg class="bi mx-auto" width="18" height="18" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#archive" />
                </svg>
                <small class="text-center">Barang</small>
            </a>
            <a class="nav-link text-secondary d-flex flex-column p-1 align-items-center" href="<?= BASEURL ?>/datariwayat">
                <svg class="bi mx-auto" width="18" height="18" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#clock-history" />
                </svg>
                <small class="text-center">Riwayat</small>
            </a>
            <div class="dropup">
                <a class="nav-link text-secondary d-flex flex-column p-1 align-items-center" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    <svg class="bi mx-auto" width="18" height="18" fill="currentColor">
                        <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#list" />
                    </svg>
                    <small class="text-center">Lainnya</small>
                </a>
                <div class="dropdown-menu dropdown-menu-right anim-fade shadow" style="width: 16em;">
                    <a class="dropdown-item" href="<?= BASEURL ?>/datapenyewa">
                        <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                            <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#person-check" />
                        </svg>
                        Penyewa
                    </a>
                    <a class="dropdown-item" href="<?= BASEURL ?>/datapaketsewa">
                        <svg class="bi mr-2" width="18" height="18" fill="currentColor">
                            <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#gift" />
                        </svg>
                        Paket Sewa
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="mx-3">
                        <span class="d-flex">
                            <svg class="bi mr-2 text-muted" width="24" height="24" fill="currentColor">
                                <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#person-circle" />
                            </svg>
                            <p class="font-weight-bold"><?= $_SESSION['nama_admin'] ?></p>
                        </span>
                    </div>
                    <a href="<?= BASEURL; ?>/editakun/changeuserinfo" class="dropdown-item">Edit profil</a>
                    <a href="<?= BASEURL; ?>/logout" class="dropdown-item">Logout</a>
                </div>
            </div>

        </div>
    </nav>