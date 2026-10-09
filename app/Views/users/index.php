<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <p class="eyebrow">TEAM DIRECTORY</p>
    <h1>User Accounts</h1>
    <p>User accounts and display-ready profile images loaded from the POS database.</p>
</section>

<section class="section">
    <?php if (session('message')): ?>
        <div class="flash flash-success" role="status"><?= esc(session('message')) ?></div>
    <?php endif ?>
    <?php if (session('error')): ?>
        <div class="flash flash-error" role="alert"><?= esc(session('error')) ?></div>
    <?php endif ?>
    <div class="table-card">
        <div class="table-card-header">
            <div>
                <h2>User list <span class="visually-hidden">— Account created records</span></h2>
                <p><?= count($users) ?> records available</p>
            </div>
            <div class="header-actions">
                <span class="data-badge">Database records</span>
                <a class="button" href="<?= site_url('users/new') ?>">Add new user</a>
            </div>
        </div>
        <?php if ($users): ?>
            <div class="table-responsive">
                <table>
                    <thead><tr><th scope="col">Profile</th><th scope="col">Username</th><th scope="col">Full name</th><th scope="col">Created</th><th scope="col">Action</th></tr></thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <?php $avatar = $user['avatar'] ?? null; ?>
                            <tr>
                                <td><div class="table-avatar"><img class="avatar-thumb" src="<?= $avatar ? esc(base_url('uploads/avatars/' . $avatar)) : esc(base_url('images/avatar-placeholder.svg')) ?>" alt="<?= esc($user['full_name']) ?> profile image"></div></td>
                                <td class="username">@<?= esc($user['username']) ?></td>
                                <td><?= esc($user['full_name']) ?></td>
                                <td><?= esc($user['created_at']) ?></td>
                                <td class="row-actions"><a class="text-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="empty-state">No users found. Add the first user account.</p>
        <?php endif ?>
    </div>
</section>
<?= $this->endSection() ?>
