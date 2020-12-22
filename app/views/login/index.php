<div class="container d-flex flex-column align-items-center justify-content-around">
    <h1 class="text-primary my-5">Login</h1>
    <?php Flasher::showFlash(); ?>
    <form action="<?= BASEURL ?>/login" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" autofocus class="form-control <?= $data['usernameError'][1] ?>" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>">
            <div class="invalid-feedback">
                <?= $data['usernameError'][0] ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control <?= $data['passwordError'][1] ?>" name="password" id="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES); ?>">
            <div class="invalid-feedback">
                <?= $data['passwordError'][0] ?>
            </div>
        </div>
        <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>
    </form>
    <p class="my-5">Belum punya akun? <a href="<?= BASEURL ?>/signup" class="text-primary">Daftar sekarang.</a></p>
</div>