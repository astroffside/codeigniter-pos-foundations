<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = $isEdit ?? false;
$user = $user ?? null;
$formTitle = $isEdit ? 'Edit User' : 'Add User';
$submitLabel = $isEdit ? 'Save changes' : 'Create user';
$formAction = $isEdit ? site_url('users/' . $user['id']) : site_url('users');
?>
<section class="page-intro">
    <p class="eyebrow">TEAM DIRECTORY</p>
    <h1><?= esc($formTitle) ?></h1>
    <p>Create or update a POS user account. An optional photo is prepared as a display-ready profile image.</p>
</section>

<section class="section form-section">
    <div class="form-card">
        <?php $errors = session('errors') ?? []; ?>
        <?php if ($errors): ?>
            <div class="flash flash-error" role="alert">
                <strong>Please correct the highlighted details.</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= esc($formAction) ?>" method="post" enctype="multipart/form-data" novalidate>
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-field">
                    <label for="username">Username <span aria-hidden="true">*</span></label>
                    <input id="username" name="username" type="text" maxlength="50" required value="<?= esc(old('username', $user['username'] ?? '')) ?>">
                </div>
                <div class="form-field">
                    <label for="full_name">Full name <span aria-hidden="true">*</span></label>
                    <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>">
                </div>
                <?php if ($isEdit): ?>
                    <div class="form-field form-field-wide">
                        <label for="avatar">Profile photo</label>
                        <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,.jpg,.jpeg,.png">
                        <p class="field-hint">Optional JPG or PNG, maximum file size 2 MB. The app prepares a square image for the user list.</p>
                    </div>
                <?php endif ?>
            </div>
            <?php if ($isEdit): ?>
                <?php $avatar = $user['avatar'] ?? null; ?>
                <div class="avatar-preview">
                    <img src="<?= $avatar ? esc(base_url('uploads/avatars/' . $avatar)) : esc(base_url('images/avatar-placeholder.svg')) ?>" alt="Current profile image">
                    <span><?= $avatar ? 'Current profile photo' : 'No photo yet — the placeholder will be shown.' ?></span>
                </div>
            <?php endif ?>
            <div class="form-actions">
                <a class="button button-secondary" href="<?= site_url('users') ?>">Cancel</a>
                <button class="button" type="submit"><?= esc($submitLabel) ?></button>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
