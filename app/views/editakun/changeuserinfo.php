<section class="col-md mt-3">
    <header class="p-2 bg-white d-flex align-items-center">
        <a href="javascript:history.go(-1)" class="float-left" title="Kembali">
            <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                <use xlink:href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#arrow-left" />
            </svg>
        </a>
        <h2 class="text-center mx-4 my-0 text-truncate">Edit Profil</h2>
    </header>
    <main class="mt-3 mx-2 mx-sm-5">
        <form action="<?= BASEURL ?>/editakun/saveuserinfo" method="post" enctype="multipart/form-data" novalidate>
            <input type="text" hidden readonly class="form-control" name="id_admin" id="id_admin" value="<?= $data['user_info']['id_admin']  ?>">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="nama_penyewa">Nama Lengkap</label>
                        <input type="text" required class="form-control" name="nama_admin" id="nama_admin" value="<?= $data['user_info']['nama_admin'] ?>">
                        <div class="invalid-feedback">Harap isi kolom ini</div>
                    </div>
                    <div class="form-group">
                        <label for="stok">Username</label>
                        <input type="hidden" disabled name="" id="username_lama" value="<?= $data['user_info']['username'] ?>">
                        <input type="text" required pattern="^(?=.*\d)(?=.*[a-z])(?!.*\s).*$" autocomplete="off" class="form-control" name="username" id="username" value="<?= $data['user_info']['username'] ?>">
                        <div class="invalid-feedback">Harap isi kolom ini</div>
                    </div>
                </div>
                <div class="col-sm"></div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary my-3">
                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                    <use href="<?= BASEURL; ?>/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#check2" />
                </svg>
                Simpan
            </button>
        </form>
    </main>
    <div style="height: 15vh;"></div>
</section>
<!-- <script src="<?= BASEURL ?>/js/formvalidate.min.js"></script> -->
<script src="<?= BASEURL ?>/js/validateUserInfo.min.js"></script>