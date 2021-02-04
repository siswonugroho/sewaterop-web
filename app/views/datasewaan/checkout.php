<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Pembayaran</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <div class="row">
            <div class="col-12 col-lg-7 p-0">
                <div class="card m-2 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Detail Sewaan</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">ID Sewaan</span>
                            <p class="col font-weight-bold"><?= strtoupper($data['formvalue']['id_pesanan']) ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">Nama Penyewa</span>
                            <p class="col font-weight-bold"><?= $data['formvalue']['nama_pemesan'] ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">Tanggal mulai sewa</span>
                            <p class="col font-weight-bold tgl-text"><?= $data['formvalue']['tgl_mulai'] ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">Tanggal berakhir</span>
                            <p class="col font-weight-bold tgl-text"><?= $data['formvalue']['tgl_selesai'] ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">Alamat Penyewa</span>
                            <p class="col font-weight-bold"><?= $data['formvalue']['alamat'] ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <span class="col">No. telepon</span>
                            <p class="col font-weight-bold"><?= $data['formvalue']['telepon'] ?></p>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <?php if (Formatter::startsWith($data['formvalue']['id_paket'], 'sw')) : ?>
                                <span class="col">Barang yang disewa</span>
                                <ul class="col">
                            <?php else : ?>
                                <span class="col">Paket sewa yang dipilih</span>
                                <ul class="col">
                                    <p class="font-weight-bold">Paket <?= $data['formvalue']['nama_paket'] ?>:</p>
                            <?php endif ?>
                                <?php foreach ($data['formvalue']['barang_sewaan']['id_barang'] as $key => $value) : ?>
                                    <li class="font-weight-bold ml-3"><?= $data['formvalue']['barang_sewaan']['jumlah_barang'][$key] . ' ' . $data['formvalue']['barang_sewaan']['nama_barang'][$key] . ' @ Rp.' . Formatter::formatRupiah($data['formvalue']['barang_sewaan']['harga'][$key]) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg p-0">
                <div class="card m-2 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Hitung Biaya</h5>
                        <form action="<?= BASEURL ?>/datasewaan/selesaikansewa" method="post" novalidate>
                        <input type="hidden" name="id_sewaan" value="<?= $data['formvalue']['id_pesanan'] ?>">
                        <input type="hidden" name="id_paket" value="<?= $data['formvalue']['id_paket'] ?>">
                            <div class="row row-cols-1">
                                <span class="col">Total Biaya</span>
                                <p class="col font-weight-bold total-biaya">Rp.<?= Formatter::formatRupiah($data['formvalue']['harga']) ?></p>
                                <input type="hidden" class="total-biaya" name="total_biaya" value="<?= $data['formvalue']['harga'] ?>">
                            </div>
                            <div class="row row-cols-1">
                                <span class="col">Kembalian</span>
                                <p class="col font-weight-bold kembalian">Rp.0</p>
                                <input type="hidden" name="kembalian" class="kembalian">
                            </div>
                            <div class="row row-cols-1">
                                <span class="col">Status</span>
                                <p class="col font-weight-bold status-sewa text-danger">-</p>
                                <input type="hidden" class="status-sewa" name="status_pembayaran" value="">
                            </div>
                            <div class="form-group">
                                <label for="total-jumlah_bayar">Jumlah Bayar (Rp)</label>
                                <input type="number" required autofocus class="form-control" placeholder="mis. 1000000" name="jumlah_bayar" id="jumlah_bayar">
                                <div class="invalid-feedback">Harap isi kolom ini</div>
                            </div>
                            <small class="text-secondary"">Sebelum mengklik Selesai, pastikan konsumen sudah menyerahkan uang kepada Anda.</small>
                            <button type="submit" class="btn btn-block btn-primary mt-2">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="white-space" style="height: 20vh;"></div>
    </main>
</section>
<script src="<?= BASEURL ?>/js/formvalidate.min.js"></script>
<script src="<?= BASEURL ?>/js/luxon.min.js"></script>
<script src="<?= BASEURL ?>/js/formatTglText.js"></script>
<script src="<?= BASEURL ?>/js/formatRupiah.js"></script>
<script src="<?= BASEURL ?>/js/checkKembalian.min.js"></script>
