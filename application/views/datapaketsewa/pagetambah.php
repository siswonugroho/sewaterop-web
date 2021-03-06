<section class="col-md mt-3">
  <header class="p-2 bg-white d-flex align-items-center">
    <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
      <svg class="bi text-primary" width="24" height="24" fill="currentColor">
        <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left'); ?>" />
      </svg>
    </a>
    <h2 class="text-center mx-4 my-0 text-truncate">Tambah Paket Sewa</h2>
  </header>
  <main class="mt-3 mx-2 mx-sm-5">
    <form action="<?= base_url('datapaketsewa/tambah') ?>" method="post" novalidate>
      <div class="row">
        <div class="col-sm">
          <input type="hidden" name="paket[id_paket]" id="id_paket" value="<?= $id_paket ?>">
          <div class="form-group">
            <label for="nama_barang">Nama Paket Sewa</label>
            <input type="text" required class="form-control" name="paket[nama_paket]" id="nama_paket">
            <div class="invalid-feedback">Harap isi kolom ini</div>
          </div>
          <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" required class="form-control" name="paket[harga]" id="harga" placeholder="Misal: 10000">
            <div class="invalid-feedback">Harap isi kolom ini</div>
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group list-barang">
            <label for="nama_barang">Isi paket</label>
            <input type="text" hidden required id="isi-paket-flag">
            <div class="invalid-feedback">Harap tambahkan setidaknya 1 isi paket</div>
          </div>
          <a class="btn btn-outline-primary" data-toggle="modal" data-target="#pilih-barang">Tambah barang</a>
        </div>
      </div>

      <button type="submit" class="btn btn-lg btn-primary my-3">
        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
          <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#check2'); ?>" />
        </svg>
        Simpan
      </button>
    </form>
  </main>
  <div style="height: 15vh;"></div>
</section>

<div class="modal fade px-0" id="pilih-barang" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <span class="modal-header">
        <h3 class="modal-title">Pilih barang</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </span>
      <div class="modal-body">
        <span class="row my-3" id="loading-list">
          <div class="spinner-border text-primary mx-auto" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </span>
      </div>
      <div class="modal-footer">
        <div class="alert alert-danger alert-dismissible fade anim-fade d-none px-3" role="alert">
          <svg class="bi text-danger mr-2" width="24" height="24" fill="currentColor">
            <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#x-circle') ?>" />
          </svg>
          Jumlah barang yang dipilih tidak boleh melebihi stok.
        </div>
        <div class="form-inline">
          <label for="pilihJumlah">Jumlah:</label>
          <input type="number" class="form-control form-control-sm  mx-1" name="jumlah" value="0" id="pilihJumlah">
        </div>
        <a class="btn btn-primary" data-dismiss="modal" id="tambahItem">Tambah</a>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/paketsewa-pagetambah.min.js') ?>"></script>
<script src="<?= base_url('assets/js/formvalidate.min.js') ?>"></script>