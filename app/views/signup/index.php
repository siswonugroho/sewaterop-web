<div class="container d-flex flex-column align-items-center justify-content-around">
    <h1 class="text-primary my-5">Buat Akun Baru</h1>
    <?php Flasher::showFlash(); ?>
    <form action="<?= BASEURL ?>/signup" method="post" novalidate>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" required pattern="[A-Za-z].*[0-9]|[0-9].*[A-Za-z]" autofocus class="form-control" autocomplete="off" name="username" id="username">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" required pattern="[A-Za-z].*[0-9]|[0-9].*[A-Za-z]" minlength="8" class="form-control" name="password" id="password">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="repassword">Ketik ulang password</label>
            <input type="password" required class="form-control" name="repassword" id="repassword" value="<?php echo htmlspecialchars($_POST['repassword'] ?? '', ENT_QUOTES); ?>">
            <div class="invalid-feedback"></div>
        </div>
        <button type="submit" name="signup" class="btn btn-block btn-primary">Buat akun</button>
    </form>
    <p class="my-5">Sudah punya akun? <a href="<?= BASEURL ?>/login" class="text-primary">Login.</a></p>
</div>
<script src="<?= BASEURL ?>/js/signup-validate.js"></script>