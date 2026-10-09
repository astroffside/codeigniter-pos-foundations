<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = $isEdit ?? false;
$customer = $customer ?? null;
$formTitle = $isEdit ? 'Edit Customer' : 'Add Customer';
$submitLabel = $isEdit ? 'Save changes' : 'Create customer';
$formAction = $isEdit ? site_url('customers/' . $customer['id']) : site_url('customers');
?>
<section class="page-intro">
    <p class="eyebrow">CUSTOMER DIRECTORY</p>
    <h1><?= esc($formTitle) ?></h1>
    <p>Enter complete customer contact details, then save them to the POS database.</p>
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

        <form action="<?= esc($formAction) ?>" method="post" novalidate>
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-field form-field-wide">
                    <label for="full_name">Full name <span aria-hidden="true">*</span></label>
                    <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>">
                </div>
                <div class="form-field">
                    <label for="email">Email address <span aria-hidden="true">*</span></label>
                    <input id="email" name="email" type="email" maxlength="100" required value="<?= esc(old('email', $customer['email'] ?? '')) ?>">
                </div>
                <div class="form-field">
                    <label for="phone">Phone number</label>
                    <input id="phone" name="phone" type="text" maxlength="20" value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>">
                </div>
            </div>
            <div class="form-actions">
                <a class="button button-secondary" href="<?= site_url('customers') ?>">Cancel</a>
                <button class="button" type="submit"><?= esc($submitLabel) ?></button>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
