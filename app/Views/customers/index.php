<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <p class="eyebrow">ACCOUNT DIRECTORY</p>
    <h1>Customer Accounts</h1>
    <p>Customer contact details loaded from the POS database.</p>
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
                <h2>Customer list</h2>
                <p><?= count($customers) ?> records available</p>
            </div>
            <div class="header-actions">
                <span class="data-badge">Database records</span>
                <a class="button" href="<?= site_url('customers/new') ?>">Add new customer</a>
            </div>
        </div>
        <?php if ($customers): ?>
            <div class="table-responsive">
                <table>
                    <thead><tr><th scope="col">Full name</th><th scope="col">Email</th><th scope="col">Phone</th><th scope="col">Action</th></tr></thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= esc($customer['full_name']) ?></td>
                                <td><a href="mailto:<?= esc($customer['email']) ?>"><?= esc($customer['email']) ?></a></td>
                                <td><?= esc($customer['phone'] ?: '—') ?></td>
                                <td class="row-actions"><a class="text-link" href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="empty-state">No customers found. Add the first customer record.</p>
        <?php endif ?>
    </div>
</section>
<?= $this->endSection() ?>
