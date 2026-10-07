<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div class="container">
        <p class="eyebrow">Staff directory</p>
        <h1>User Accounts</h1>
        <p class="lead">Staff account details loaded from the POS database.</p>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <h2>User list</h2>
                    <p><?= count($users) ?> records available</p>
                </div>
                <span class="data-badge">Database records</span>
            </div>
            <div class="table-wrapper">
                <table>
                    <caption class="visually-hidden">User account records</caption>
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Full name</th>
                            <th scope="col">Account created</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($users === []): ?>
                        <tr>
                            <td colspan="3">No user accounts have been added yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><span class="username">@<?= esc($user['username']) ?></span></td>
                                <td><?= esc($user['full_name']) ?></td>
                                <td><?= esc($user['created_at'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
