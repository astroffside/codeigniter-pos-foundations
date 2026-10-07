<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">CodeIgniter 4 activity</p>
            <h1>A POS system with database-backed account pages.</h1>
            <p class="lead">This CodeIgniter application uses focused routes, controllers, models, and views to display customer and user records stored in MySQL.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="<?= site_url('customers') ?>">View customer accounts</a>
                <a class="button button-secondary" href="<?= site_url('about') ?>">Learn about the activity</a>
            </div>
        </div>
        <aside class="hero-panel" aria-label="Application overview">
            <p class="panel-label">Application status</p>
            <strong>4</strong>
            <span>working pages</span>
            <ul>
                <li>Routes map URLs to controllers</li>
                <li>Controllers retrieve records through Models</li>
                <li>MySQL stores customer and user accounts</li>
            </ul>
        </aside>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Explore the app</p>
            <h2>Built to show the MVC flow with real data.</h2>
        </div>
        <div class="card-grid">
            <a class="feature-card" href="<?= site_url('about') ?>">
                <span class="card-number">01</span>
                <h3>About</h3>
                <p>See how routes, controllers, Models, and views work together in this application.</p>
            </a>
            <a class="feature-card" href="<?= site_url('customers') ?>">
                <span class="card-number">02</span>
                <h3>Customer Accounts</h3>
                <p>Browse customer contact details retrieved from the customers table.</p>
            </a>
            <a class="feature-card" href="<?= site_url('users') ?>">
                <span class="card-number">03</span>
                <h3>User Accounts</h3>
                <p>Review staff usernames and full names retrieved from the users table.</p>
            </a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
