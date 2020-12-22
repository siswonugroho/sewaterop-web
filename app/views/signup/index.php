<div class="container d-flex flex-column align-items-center justify-content-around">
    <h1 class="text-primary my-5">Buat Akun Baru</h1>
    <?php Flasher::showFlash(); ?>
    <form action="<?= BASEURL ?>/signup" method="post" novalidate>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" autofocus class="form-control <?= $data['usernameError'][1] ?>" autocomplete="off" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>">
            <div class="invalid-feedback"><?= $data['usernameError'][0] ?></div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control <?= $data['passwordError'][1] ?>" name="password" id="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES); ?>">
            <div class="invalid-feedback"><?= $data['passwordError'][0] ?></div>
        </div>
        <div class="form-group">
            <label for="repassword">Ketik ulang password</label>
            <input type="password" class="form-control <?= $data['repasswordError'][1] ?>" name="repassword" id="repassword" value="<?php echo htmlspecialchars($_POST['repassword'] ?? '', ENT_QUOTES); ?>">
            <div class="invalid-feedback"><?= $data['repasswordError'][0] ?></div>
        </div>
        <button type="submit" name="signup" class="btn btn-block btn-primary">Buat akun</button>
    </form>
    <p class="my-5">Sudah punya akun? <a href="<?= BASEURL ?>/login" class="text-primary">Login.</a></p>
</div>