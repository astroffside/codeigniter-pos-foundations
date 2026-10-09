<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CodeIgniter 4 Point-of-Sale application with database-backed accounts">
    <title><?= esc($title ?? 'CodeIgniter POS') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tfa3.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="<?= site_url('/') ?>">
                <span class="brand-mark" aria-hidden="true">P</span>
                <span>POS Accounts</span>
            </a>

            <nav class="main-nav" aria-label="Primary navigation">
                <a class="<?= ($activePage ?? '') === 'home' ? 'is-active' : '' ?>" href="<?= site_url('/') ?>">Home</a>
                <a class="<?= ($activePage ?? '') === 'about' ? 'is-active' : '' ?>" href="<?= site_url('about') ?>">About</a>
                <a class="<?= ($activePage ?? '') === 'customers' ? 'is-active' : '' ?>" href="<?= site_url('customers') ?>">Customers</a>
                <a class="<?= ($activePage ?? '') === 'users' ? 'is-active' : '' ?>" href="<?= site_url('users') ?>">Users</a>
            </nav>
        </div>
    </header>

    <main id="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>CodeIgniter 4 POS Accounts &middot; MySQL database demonstration</p>
        </div>
    </footer>
</body>
</html>
