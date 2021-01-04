    <nav class="navbar navbar-expand-md bg-white sticky-top shadow">
        <div class="container">
            <a href="<?= BASEURL; ?>" class="navbar-brand font-weight-bold text-dark"><?= $data['judul']; ?></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="navbar-nav ml-auto d-flex align-items-center">
                <li class="nav-item active mx-1">
                    <?php if (Session::isLoggedIn()) : ?>
                        <a href="<?= BASEURL; ?>/signup" class="btn btn-outline-dark d-none">Daftar</a>
                    <?php else : ?>
                        <a href="<?= BASEURL; ?>/signup" class="btn btn-outline-dark">Daftar</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item active mx-1">
                    <?php if (Session::isLoggedIn()) : ?>
                        <a href="<?= BASEURL; ?>/logout" class="btn btn-dark">Logout</a>
                    <?php else : ?>
                        <a href="<?= BASEURL; ?>/login" class="btn btn-dark">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>