<div class="container d-flex flex-column align-items-center justify-content-around min-vh-100">
    <img src="<?= base_url("assets/img/sewaterop-logo.svg") ?>" alt="Logo sewaterop" height="64">
    <h1 class="text-primary my-5">Login</h1>
    <?php showFlash(); ?>
    <div class="row w-100 justify-content-center">
        <form action="<?= base_url('login/gologin') ?>" class="col-md-4" method="post" novalidate>
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
    </div>

    <p class="my-5 text-center">Belum punya akun? <a href="<?= base_url('signup') ?>" class="text-primary">Daftar sekarang.</a></p>
</div>
<script src="<?= base_url('assets/js/login-validate.min.js'); ?>"></script>