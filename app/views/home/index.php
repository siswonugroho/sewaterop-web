    <section class="col-md m-0 m-md-3">
        <?php Flasher::showFlash() ?>
        <header class="p-2 my-2 my-md-1 bg-transparent">
            <figure class="d-flex d-md-none">
                <img src="<?= BASEURL ?>/img/sewaterop-logo.svg" alt="Logo sewaterop" style="height: 7vh;">
            </figure>
            <h2 class="text-truncate font-weight-bold"><span id="welcome-text">Halo</span></h2>
            <p class="text-truncate m-0">Berikut statistik Anda hingga hari ini.</p>
        </header>
        <main class="mx-4 my-3">
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
        </main>

        <section class="top-5-data row row-cols-1 row-cols-sm-2 mt-5">
            <div class="segera-berakhir col my-4">
                <h2 class="mx-3 font-weight-bold">Segera berakhir</h2>
                <div class="list-group list-group-flush">
                    <span class="text-secondary no-list text-center mt-5">Memuat...</span>
                </div>
            </div>
            <div class="sewa-terbaru col my-4">
                <h2 class="mx-3 font-weight-bold">Sewa terbaru</h2>
                <div class="list-group list-group-flush">
                    <span class="text-secondary no-list text-center mt-5">Memuat...</span>
                </div>
            </div>
        </section>
    </section>
    <div class="white-space" style="height: 10vh;"></div>
    <script src="<?= BASEURL ?>/js/greetings.js"></script>
    <script src="<?= BASEURL ?>/js/luxon.min.js"></script>
    <script src="<?= BASEURL ?>/js/date-formatter.js"></script>
    <script src="<?= BASEURL ?>/js/home.min.js"></script>