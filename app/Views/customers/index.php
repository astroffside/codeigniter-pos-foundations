<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div class="container">
        <p class="eyebrow">Account directory</p>
        <h1>Customer Accounts</h1>
        <p class="lead">Customer contact details loaded from the POS database.</p>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <h2>Customer list</h2>
                    <p><?= count($customers) ?> records available</p>
                </div>
                <span class="data-badge">Database records</span>
            </div>
            <div class="table-wrapper">
                <table>
                    <caption class="visually-hidden">Customer account records</caption>
                    <thead>
                        <tr>
                            <th scope="col">Full name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($customers === []): ?>
                        <tr>
                            <td colspan="3">No customer accounts have been added yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= esc($customer['full_name']) ?></td>
                                <td><a href="mailto:<?= esc($customer['email']) ?>"><?= esc($customer['email']) ?></a></td>
                                <td><?= esc($customer['phone'] ?? '—') ?></td>
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
