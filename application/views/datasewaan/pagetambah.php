<section class="col-md mt-3">
  <header class="p-2 bg-white d-flex align-items-center">
    <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
      <svg class="bi text-primary" width="24" height="24" fill="currentColor">
        <use href="<?= base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left'); ?>" />
      </svg>
    </a>
    <h2 class="text-center mx-4 my-0 text-truncate">Buat Sewa Baru</h2>
  </header>
  <main class="mt-3 mx-2 mx-sm-5">
    <form action="<?= base_url('datasewaan/tambah') ?>" method="post" novalidate>
      <div class="row">
        <div class="col-sm">
          <input type="text" hidden name="id_sewaan" id="id_sewaan" value="<?= $id_sewaan ?>">
          <div class="form-group">
            <label for="nama_penyewa">Pilih penyewa</label>
            <div class="dropdown">
              <input type="text" hidden name="id_penyewa" id="id_penyewa" autocomplete="off">
              <input type="text" required readonly class="form-control bg-white" name="nama_penyewa" id="nama_penyewa" autocomplete="off" placeholder="Klik untuk memilih..." data-toggle="dropdown">
              <div class="invalid-feedback">Harap isi kolom ini</div>
              <div class="dropdown-menu dropdown-input shadow border-0" style="max-height: 50vh; overflow-y: auto;">
                <a href="<?= base_url('datapenyewa/pagetambah') ?>" class="text-primary mx-4" type="button">Tambah penyewa</a>
                <div class="dropdown-divider"></div>
                <div class="daftar-penyewa">

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md col-lg-7 form-group">
              <label for="tgl_mulai" class="text-truncate">Tanggal mulai</label>
              <input type="date" required class="form-control" name="tgl_mulai" id="tgl_mulai">
            </div>
            <div class="col-md col-lg-5 form-group">
              <label for="waktu_mulai" class="text-truncate">Waktu mulai</label>
              <input type="time" required class="form-control" name="waktu_mulai" id="waktu_mulai">
            </div>
          </div>
          <div class="row">
            <div class="col-md col-lg-7 form-group">
              <label for="tgl_selesai" class="text-truncate">Tanggal berakhir</label>
              <input type="date" required class="form-control" name="tgl_selesai" id="tgl_selesai">
            </div>
            <div class="col-md col-lg-5 form-group">
              <label for="waktu_selesai" class="text-truncate">Waktu berakhir</label>
              <input type="time" required class="form-control" name="waktu_selesai" id="waktu_selesai">
            </div>
          </div>
          <div class="form-group">
            <label>Pilih barang dari</label>
            <div class="custom-control custom-radio">
              <input type="radio" id="paket" name="tipe_sewaan" class="custom-control-input" value="paket">
              <label class="custom-control-label" for="paket">Paket sewa</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="non-paket" name="tipe_sewaan" class="custom-control-input" value="non-paket">
              <label class="custom-control-label" for="non-paket">Daftar barang</label>
            </div>
            <div class="invalid-feedback">Harap isi kolom ini</div>
          </div>
          <div class="form-group list-barang d-none">
            <label for="nama_barang">Barang yang disewa</label>
            <a class="btn btn-outline-primary d-block mb-2" data-toggle="modal" data-target="#pilih-barang">Tambah barang</a>
            <input type="text" hidden required id="isi-paket-flag">
            <div class="invalid-feedback">Harap tambahkan setidaknya 1 barang</div>
          </div>
          <div class="form-group pilih-paket d-none">
            <label>Pilih paket sewa</label>
            <div class="row row-cols-2 mx-0 daftar-paket-sewa" data-toggle="buttons">

            </div>
            <div class="invalid-feedback">Harap isi kolom ini</div>
          </div>
        </div>
        <div class="col-sm-4">

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

<script src="<?= base_url('assets/js/formatRupiah.min.js') ?>"></script>
<script src="<?= base_url('assets/js/sewaan-form-common.min.js') ?>"></script>
<script src="<?= base_url('assets/js/formvalidate.min.js') ?>"></script>