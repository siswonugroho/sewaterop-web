<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Edit Sewaan</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <form action="<?= BASEURL ?>/datasewaan/edit" method="post" novalidate>
            <div class="row">
                <div class="col-sm">
                    <input type="text" hidden name="id_sewaan" id="id_sewaan" value="<?= $data['formvalue']['id_pesanan'] ?>">
                    <input type="text" hidden name="id_paket_lama" id="id_paket_lama" value="<?= $data['formvalue']['id_paket'] ?>">
                    <div class="form-group">
                        <label for="nama_penyewa">Pilih penyewa</label>
                        <div class="dropdown">
                            <input type="text" hidden value="<?= $data['formvalue']['id_pemesan'] ?>" name="id_penyewa" id="id_penyewa" autocomplete="off">
                            <input type="text" required value="<?= $data['formvalue']['nama_pemesan'] ?>" class="form-control" name="nama_penyewa" id="nama_penyewa" autocomplete="off" data-toggle="dropdown">
                            <div class="invalid-feedback">Harap isi kolom ini</div>
                            <div class="dropdown-menu dropdown-input shadow border-0" style="max-height: 50vh; overflow-y: auto;">
                                <a href="<?= BASEURL ?>/datapenyewa/pagetambah" class="text-primary mx-4" type="button">Tambah penyewa</a>
                                <div class="dropdown-divider"></div>
                                <div class="daftar-penyewa">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_mulai">Tanggal mulai</label>
                        <input type="date" required class="form-control" value="<?= $data['formvalue']['tgl_mulai'] ?>" name="tgl_mulai" id="tgl_mulai">
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal selesai</label>
                        <input type="date" required class="form-control" value="<?= $data['formvalue']['tgl_selesai'] ?>" name="tgl_selesai" id="tgl_selesai">
                    </div>
                    <div class="form-group">
                        <label>Pilih barang dari</label>
                        <?php if (Formatter::startsWith($data['formvalue']['id_paket'], 'sw')) : ?>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="paket" name="tipe_sewaan" class="custom-control-input" value="paket">
                            <label class="custom-control-label" for="paket">Paket sewa</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" checked='' id="non-paket" name="tipe_sewaan" class="custom-control-input" value="non-paket">
                            <label class="custom-control-label" for="non-paket">Daftar barang</label>
                        </div>
                        <div class="invalid-feedback">Harap isi kolom ini</div>
                    </div>
                    <div class="form-group list-barang d-block">
                        <label for="nama_barang">Barang yang disewa</label>
                        <a class="btn btn-outline-primary d-block mb-2" data-toggle="modal" data-target="#pilih-barang">Tambah barang</a>
                        <input type="text" hidden required id="isi-paket-flag">
                        <div class="invalid-feedback">Harap tambahkan setidaknya 1 isi paket</div>
                        <?php foreach ($data['formvalue']['barang_sewaan']['id_barang'] as $key => $value) : ?>
                        <div class="input-group list-item">
                            <input type="number" readonly name="paket[jumlah_barang][]" class="form-control bg-white jumlah" value="<?= $data['formvalue']['barang_sewaan']['jumlah_barang'][$key] ?>">
                            <input type="hidden" name="paket[id_barang][]" class="jumlah" value="<?= $data['formvalue']['barang_sewaan']['id_barang'][$key] ?>">
                            <input type="text" readonly name="paket[nama_barang][]" class="form-control bg-white w-50 nama" value="<?= $data['formvalue']['barang_sewaan']['nama_barang'][$key] ?>">
                            <input type="hidden" name="paket[harga][]" class="harga" value="<?= $data['formvalue']['barang_sewaan']['harga'][$key] ?>">
                            <div class="input-group-append remove-btn">
                                <a href="javascript:void(0)" class="text-decoration-none input-group-text">&times;</a>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <div class="form-group pilih-paket d-none">
                        <label for="nama_paket">Pilih paket sewa</label>
                        <div class="dropdown">
                            <input type="text" hidden disabled name="id_paket" id="id_paket" autocomplete="off" value="">
                            <input type="text" required disabled class="form-control" name="nama_paket" id="nama_paket" autocomplete="off" value="" data-toggle="dropdown">
                            <div class="invalid-feedback">Harap isi kolom ini</div>
                            <div class="dropdown-menu dropdown-paket-sewa shadow border-0" style="max-height: 50vh; overflow-y: auto;">
                                <div class="daftar-paket-sewa">

                                </div>
                            </div>
                        </div>
                    </div>
                        <?php else : ?>
                        <div class="custom-control custom-radio">
                            <input type="radio" checked='' id="paket" name="tipe_sewaan" class="custom-control-input" value="paket">
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
                        <input type="text" hidden required disabled id="isi-paket-flag">
                        <div class="invalid-feedback">Harap tambahkan setidaknya 1 isi paket</div>
                    </div>
                    <div class="form-group pilih-paket d-block">
                        <label for="nama_paket">Pilih paket sewa</label>
                        <div class="dropdown">
                            <input type="text" hidden name="id_paket" id="id_paket" autocomplete="off" value="<?= $data['formvalue']['id_paket'] ?>">
                            <input type="text" required class="form-control" name="nama_paket" id="nama_paket" autocomplete="off" value="<?= $data['formvalue']['nama_paket'] ?>" data-toggle="dropdown">
                            <div class="invalid-feedback">Harap isi kolom ini</div>
                            <div class="dropdown-menu dropdown-paket-sewa shadow border-0" style="max-height: 50vh; overflow-y: auto;">
                                <div class="daftar-paket-sewa">
    
                                </div>
                            </div>
                        </div>
                    </div>

            <?php endif ?>
                </div>
                <div class="col-sm">
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
                        <use xlink:href="<?= BASEURL ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#x-circle" />
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

<script src="<?= BASEURL ?>/js/sewaan-pagetambah.min.js"></script>
<script src="<?= BASEURL ?>/js/formvalidate.min.js"></script>