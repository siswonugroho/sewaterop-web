<section class="col-md pt-3 bg-secondary min-vh-100">
    <header class="p-2 d-flex align-items-center text-white">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-light" width="24" height="24" fill="currentColor">
                <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left'); ?>" />
            </svg>
        </a>
        <h2 class="mx-3 my-0 text-truncate flex-grow-1">Struk Transaksi</h2>

    </header>
    <a class="btn btn-lg btn-success shadow-sm d-block my-3 text-truncate mx-auto" style="width: fit-content;" id="downloadStruk" download="struk-sewa-<?= $formvalue['id_pesanan'] ?>.jpg">
        <svg class="bi mr-2" width="18" height="18" fill="currentColor">
            <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#download'); ?>" />
        </svg>
        Download Struk
    </a>
    <small class="text-light text-center d-flex d-sm-none justify-content-center mb-3">Jika tampilan struk terpotong, scroll struk ke kanan atau ke kiri.</small>
    <main class="mt-3 mx-2 overflow-auto">
        <div class="gambar-struk bg-white mx-auto" style="width: 130mm; height: fit-content;">
            <header class="text-center font-weight-bold pt-3 px-3">
                <p class="text-uppercase m-0">Sewa Barang Pernikahan H. Nashir</p>
                <small class="m-0">Gudang Persewaan Tenda Utara Perum Kodim Jubung Lor Kec.Sukorambi, Jember</small><br>
                <small class="m-0">Telepon 03517598247</small>
            </header>
            <hr>
            <section class="p-2">
                <div class="row m-0 justify-content-center">
                    <div class="col-5">ID sewaan</div>
                    <div class="">:</div>
                    <div class="col text-uppercase"><?= $formvalue['id_pesanan'] ?></div>
                </div>
                <div class="row m-0 justify-content-center">
                    <div class="col-5">Nama penyewa</div>
                    <div class="">:</div>
                    <div class="col"><?= $formvalue['nama_pemesan'] ?></div>
                </div>
                <div class="row m-0 justify-content-center">
                    <div class="col-5">Tgl sewa</div>
                    <div class="">:</div>
                    <div class="col tgl-text"><?= $formvalue['tgl_mulai'] ?> <?= $formvalue['waktu_mulai'] ?></div>
                </div>
                <div class="row m-0 justify-content-center">
                    <div class="col-5">Tgl berakhir</div>
                    <div class="">:</div>
                    <div class="col tgl-text"><?= $formvalue['tgl_selesai'] ?> <?= $formvalue['waktu_selesai'] ?></div>
                </div>

                <?php if (startsWith($formvalue['id_paket'], 'sw')) : ?>
                    <div class="row m-0 justify-content-center">
                        <div class="col-5">Paket sewa</div>
                        <div class="">:</div>
                        <div class="col">-</div>
                    </div>
                    <div class="row m-0 justify-content-center">
                        <div class="col-5">Barang yg disewa</div>
                        <div class="">:</div>
                        <ul class="col ml-2">
                            <?php foreach ($formvalue['barang_sewaan']['id_barang'] as $key => $value) : ?>
                                <li><?= $formvalue['barang_sewaan']['jumlah_barang'][$key] . ' ' . $formvalue['barang_sewaan']['nama_barang'][$key] . ' @ Rp.' . formatRupiah($formvalue['barang_sewaan']['harga_barang'][$key]) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                <?php else : ?>
                    <div class="row m-0 justify-content-center">
                        <div class="col-5">Paket sewa</div>
                        <div class="">:</div>
                        <div class="col"><?= $formvalue['nama_paket'] ?></div>
                    </div>
                    <div class="row m-0 justify-content-center">
                        <div class="col-5">Harga paket sewa</div>
                        <div class="">:</div>
                        <div class="col">Rp.<?= formatRupiah($formvalue['total_biaya']) ?></div>
                    </div>
                    <div class="row m-0 justify-content-center">
                        <div class="col-5">Isi paket</div>
                        <div class="">:</div>
                        <ul class="col ml-2">
                            <?php foreach ($formvalue['barang_sewaan']['id_barang'] as $key => $value) : ?>
                                <li><?= $formvalue['barang_sewaan']['jumlah_barang'][$key] . ' ' . $formvalue['barang_sewaan']['nama_barang'][$key] ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
            </section>
            <hr>
            <section class="px-2">
                <div class="row m-0 justify-content-center font-weight-bold">
                    <div class="col-5">Total</div>
                    <div class="">:</div>
                    <div class="col">Rp.<?= formatRupiah($formvalue['total_biaya']) ?></div>
                </div>
                <div class="row m-0 justify-content-center font-weight-bold">
                    <div class="col-5">Bayar</div>
                    <div class="">:</div>
                    <div class="col">Rp.<?= formatRupiah($formvalue['jumlah_bayar']) ?></div>
                </div>
                <div class="row m-0 justify-content-center font-weight-bold">
                    <?php if (startsWith($formvalue['kembalian'], '-')): ?>
                    <div class="col-5">Kurang</div>
                    <?php else: ?>
                    <div class="col-5">Kembalian</div>
                    <?php endif ?>
                    <div class="">:</div>
                    <div class="col">Rp.<?= formatRupiah(str_replace('-','',$formvalue['kembalian'])) ?></div>
                </div>
                <div class="row m-0 justify-content-center font-weight-bold">
                    <div class="col-5">Status</div>
                    <div class="">:</div>
                    <div class="col"><?= $formvalue['status_pembayaran'] ?></div>
                </div>
            </section>
            <hr>
            <footer class="pb-5 text-center text-uppercase">
                TERIMAKASIH<br>KEMBALI LAGI YA.
            </footer>
        </div>
    </main>
    <div class="white-space" style="height: 20vh;"></div>
</section>
<script src="<?= base_url('assets/js/luxon.min.js') ?>"></script>
<script src="<?= base_url('assets/js/formatTglText.js') ?>"></script>
<script src="<?= base_url('assets/js/html2canvas.min.js') ?>"></script>
<script src="<?= base_url('assets/js/capture-struk.js') ?>"></script>