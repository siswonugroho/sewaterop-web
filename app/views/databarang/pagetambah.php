<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Tambah Barang Baru</h2>
    </header>
    
    <main class="mt-3 mx-2 mx-sm-5">
        <form action="<?= BASEURL ?>/databarang/tambah" method="post" enctype="multipart/form-data" novalidate>
            <div class="row">
                <div class="col-sm">
                    <input type="text" hidden readonly class="form-control" name="id_barang" id="id_barang" value="<?= $data['id_barang'] ?>">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" required class="form-control" name="nama_barang" id="nama_barang">
                        <div class="invalid-feedback">Harap isi kolom ini</div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga (Rp)</label>
                        <input type="number" required class="form-control" name="harga" id="harga" placeholder="Misal: 10000">
                        <div class="invalid-feedback">Harap isi kolom ini</div>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" required class="form-control" name="stok" id="stok">
                        <div class="invalid-feedback">Harap isi kolom ini</div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group d-flex flex-column" style="width: 30vh;">
                        <label for="preview_foto_barang">Foto Barang</label>
                        <img src="" alt="foto barang" class="rounded-sm img-thumbnail" style="object-fit: cover; height: 30vh; width: 30vh;" onerror="this.onerror = null; this.src = '<?= BASEURL ?>/resources/img/noimg.png'" id="preview_foto_barang">
                        <label for="foto_barang" class="btn btn-sm btn-outline-dark my-2">Upload Foto</label>
                        <small id="foto_barang_help" class="form-text text-muted">
                            Format gambar harus berupa jpeg/png.
                        </small>
                        <input type="file" hidden accept="image/jpeg,image/png" class="form-control-file" name="foto_barang" id="foto_barang" aria-describedby="foto_barang_help">
                    </div>
                </div>
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

<script src="<?= BASEURL ?>/js/file-input.min.js"></script>
<script src="<?= BASEURL ?>/js/formvalidate.min.js"></script>