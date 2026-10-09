<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="login-page" aria-labelledby="login-heading">
    <div class="login-card">
        <p class="eyebrow">STAFF ACCESS</p>
        <h1 id="login-heading">Sign in to POS Accounts</h1>
        <p>Use your staff username and password to manage customer and user records.</p>

        <?php $errors = session('errors') ?? []; ?>
        <?php if (session('message')): ?>
            <div class="flash flash-success" role="status"><?= esc(session('message')) ?></div>
        <?php endif ?>
        <?php if (session('error')): ?>
            <div class="flash flash-error" role="alert"><?= esc(session('error')) ?></div>
        <?php endif ?>
        <?php if ($errors): ?>
            <div class="flash flash-error" role="alert">
                <strong>Please complete both fields.</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= site_url('login') ?>" method="post" class="login-form" novalidate>
            <?= csrf_field() ?>
            <div class="form-field">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" maxlength="50" required autocomplete="username" value="<?= esc(old('username')) ?>">
            </div>
            <div class="form-field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password">
            </div>
            <button class="button" type="submit">Sign in</button>
        </form>

        <p class="login-help">For the seeded class accounts, use the username shown in the Users list and password <code>pos12345</code>.</p>
    </div>
</section>
<?= $this->endSection() ?>
