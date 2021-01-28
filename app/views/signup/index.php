<div class="container d-flex flex-column align-items-center justify-content-around">
    <img src="<?= BASEURL ?>/img/sewaterop-logo.svg" alt="Logo sewaterop" height="64">
    <h1 class="text-primary my-5">Buat Akun Baru</h1>
    <?php Flasher::showFlash(); ?>
    <div class="row w-100 justify-content-center">
        <form action="<?= BASEURL ?>/signup" class="col-md-4" method="post" novalidate>
            <div class="form-group">
                <label for="username">Nama Lengkap</label>
                <input type="text" required autofocus class="form-control form-control-sm" autocomplete="off" name="nama_admin" id="nama_admin">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" required pattern="^(?=.*\d)(?=.*[a-z])(?!.*\s).*$" class="form-control form-control-sm" autocomplete="off" name="username" id="username">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required pattern="^(?=.*\d)(?=.*[a-z])(?!.*\s).*$" minlength="8" class="form-control form-control-sm" name="password" id="password">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="repassword">Ketik ulang password</label>
                <input type="password" required class="form-control form-control-sm" name="repassword" id="repassword" value="<?php echo htmlspecialchars($_POST['repassword'] ?? '', ENT_QUOTES); ?>">
                <div class="invalid-feedback"></div>
            </div>
            <button type="submit" name="signup" class="btn btn-block btn-primary">Buat akun</button>
        </form>
    </div>

    <p class="my-5">Sudah punya akun? <a href="<?= BASEURL ?>/login" class="text-primary">Login.</a></p>
</div>
<script src="<?= BASEURL ?>/js/signup-validate.min.js"></script>