<div class="container d-flex flex-column align-items-center justify-content-around min-vh-100">
    <img src="<?= BASEURL ?>/img/sewaterop-logo.svg" alt="Logo sewaterop" height="64">
    <h1 class="text-primary my-5">Login</h1>
    <?php Flasher::showFlash(); ?>
    <form action="<?= BASEURL ?>/login" method="post" novalidate>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" required autofocus class="form-control" name="username" id="username">
            <div class="invalid-feedback">
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" required class="form-control" name="password" id="password">
            <div class="invalid-feedback">
            </div>
        </div>
        <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>
    </form>
    <p class="my-5">Belum punya akun? <a href="<?= BASEURL ?>/signup" class="text-primary">Daftar sekarang.</a></p>
</div>
<script src="<?= BASEURL; ?>/js/login-validate.min.js"></script>