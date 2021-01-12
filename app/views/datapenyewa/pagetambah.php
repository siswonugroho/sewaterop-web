<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Tambah Penyewa Baru</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <form action="<?= BASEURL ?>/datapenyewa/tambah" method="post" enctype="multipart/form-data" novalidate>
            <input type="text" hidden readonly class="form-control" name="id_penyewa" id="id_penyewa" value="<?= $data['id_penyewa'] ?>">
            <div class="form-group">
                <label for="nama_penyewa">Nama Penyewa</label>
                <input type="text" required class="form-control" name="nama_penyewa" id="nama_penyewa">
                <div class="invalid-feedback">Harap isi kolom ini</div>
            </div>
            <div class="form-group">
                <label for="stok">No. Telepon</label>
                <input type="number" required class="form-control" name="telepon" id="telepon">
                <div class="invalid-feedback">Harap isi kolom ini</div>
            </div>
            <div class="form-group">
                <label for="harga">Alamat</label>
                <textarea required rows="4" class="form-control" name="alamat" id="alamat"></textarea>
                <div class="invalid-feedback">Harap isi kolom ini</div>
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
<script src="<?= BASEURL ?>/js/formvalidate.min.js"></script>