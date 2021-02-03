    <section class="col-md m-0 m-md-3">
        <?php Flasher::showFlash() ?>
        <header class="p-2 my-2 my-md-1 bg-transparent">
            <figure class="d-flex d-md-none">
                <img src="<?= BASEURL ?>/img/sewaterop-logo.svg" alt="Logo sewaterop" style="height: 7vh;">
            </figure>
            <h2 class="text-truncate font-weight-bold"><span id="welcome-text">Halo</span></h2>
            <p class="text-truncate m-0">Berikut statistik Anda hingga hari ini.</p>
        </header>
        <section class="mx-4 my-3">
            <div class="row row-cols-2 row-cols-lg-4">
                <div class="col p-1">
                    <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(126deg, rgba(27,98,224,1) 0%, rgba(54,181,246,1) 100%);">
                        <div class="card-body text-white">
                            <h1 class="display-4 font-weight-bold"><?= $data['count-summary']['jumlah-sewa'] ?></h1>
                            <span>Sewa berlangsung</span>
                        </div>
                        <div class="card-footer border-0 bg-transparent">
                            <a href="<?= BASEURL ?>/datasewaan" class="font-weight-bold text-light">Lihat semua</a>
                        </div>
                    </div>
                </div>
                <div class="col p-1">
                    <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(126deg, rgba(23,178,210,1) 0%, rgba(16,217,174,1) 100%);">
                        <div class="card-body text-white">
                            <h1 class="display-4 font-weight-bold"><?= $data['count-summary']['jumlah-barang'] ?></h1>
                            <span>Jenis barang</span>
                        </div>
                        <div class="card-footer border-0 bg-transparent">
                            <a href="<?= BASEURL ?>/databarang" class="font-weight-bold text-light">Lihat semua</a>
                        </div>
                    </div>
                </div>
                <div class="col p-1">
                    <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(126deg, rgba(58,79,230,1) 0%, rgba(171,63,221,1) 100%);">
                        <div class="card-body text-white">
                            <h1 class="display-4 font-weight-bold"><?= $data['count-summary']['jumlah-paket'] ?></h1>
                            <span>Paket sewa</span>
                        </div>
                        <div class="card-footer border-0 bg-transparent">
                            <a href="<?= BASEURL ?>/datapaketsewa" class="font-weight-bold text-light">Lihat semua</a>
                        </div>
                    </div>
                </div>
                <div class="col p-1">
                    <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(126deg, rgba(230,58,131,1) 0%, rgba(243,143,67,1) 100%);">
                        <div class="card-body text-white">
                            <h1 class="display-4 font-weight-bold"><?= $data['count-summary']['jumlah-blm-lunas'] ?></h1>
                            <span>Sewaan belum lunas</span>
                        </div>
                        <div class="card-footer border-0 bg-transparent">
                            <a href="<?= BASEURL ?>/datariwayat/blmlunas" class="font-weight-bold text-light">Lihat semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="d-block d-md-none">
            <div class="card shadow-sm border-0 mx-2">
                <span class="card-header pt-4 bg-transparent border-0">
                    <h2 class="font-weight-bold">Lihat dan Kelola</h2>
                </span>
                <div class="card-body">
                    <div class="row row-cols-3">
                        <a class="col text-dark d-flex flex-column justify-content-center align-items-center" href="<?= BASEURL ?>/databarang">
                            <figure class="rounded-circle bg-danger m-0 d-flex justify-content-center align-items-center" style="height: 3em; width: 3em;">
                                <svg class="bi text-white" width="24" height="24" fill="currentColor">
                                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#archive" />
                                </svg>
                            </figure>
                            <span class="mt-2 text-center text-truncate">Barang</span>
                        </a>
                        <a class="col text-dark d-flex flex-column justify-content-center align-items-center" href="<?= BASEURL ?>/datapenyewa">
                            <figure class="rounded-circle bg-primary m-0 d-flex justify-content-center align-items-center" style="height: 3em; width: 3em;">
                                <svg class="bi text-white" width="24" height="24" fill="currentColor">
                                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#person-check" />
                                </svg>
                            </figure>
                            <span class="mt-2 text-center text-truncate">Penyewa</span>
                        </a>
                        <a class="col text-dark d-flex flex-column justify-content-center align-items-center" href="<?= BASEURL ?>/datapaketsewa">
                            <figure class="rounded-circle bg-info m-0 d-flex justify-content-center align-items-center" style="height: 3em; width: 3em;">
                                <svg class="bi text-white" width="24" height="24" fill="currentColor">
                                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#gift" />
                                </svg>
                            </figure>
                            <span class="mt-2 text-center text-truncate">Paket Sewa</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="top-5-data row row-cols-1 row-cols-sm-2 mt-4">
            <div class="sewa-terbaru col my-4">
                <h2 class="mx-3 font-weight-bold">Sewa terbaru</h2>
                <div class="list-group list-group-flush">
                    <span class="text-secondary no-list text-center mt-5">Memuat...</span>
                    <button class="btn text-primary text-center my-4 mx-2 try-again sewa-terbaru d-none">Coba Lagi</button>
                </div>
            </div>
            <div class="segera-berakhir col my-4">
                <h2 class="mx-3 font-weight-bold">Segera berakhir</h2>
                <div class="list-group list-group-flush">
                    <span class="text-secondary no-list text-center mt-5">Memuat...</span>
                    <button class="btn text-primary text-center my-4 mx-2 try-again segera-berakhir d-none">Coba Lagi</button>
                </div>
            </div>
        </section>
        <div class="white-space" style="height: 10vh;"></div>
    </section>
    <script src="<?= BASEURL ?>/js/greetings.js"></script>
    <script src="<?= BASEURL ?>/js/luxon.min.js"></script>
    <script src="<?= BASEURL ?>/js/date-formatter.js"></script>
    <script src="<?= BASEURL ?>/js/home.min.js"></script>