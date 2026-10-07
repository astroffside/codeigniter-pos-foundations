<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div class="container narrow">
        <p class="eyebrow">About this activity</p>
        <h1>From arrays to a real POS database.</h1>
        <p class="lead">This project demonstrates how CodeIgniter's MVC architecture connects account pages to a MySQL database through Models and Query Builder methods.</p>
    </div>
</section>

<section class="section section-muted">
    <div class="container narrow">
        <div class="content-stack">
            <article>
                <h2>How a request is handled</h2>
                <p>A route decides which controller method should respond to a URL. The controller asks a Model for the page data, then passes the retrieved records to a view. The view renders the HTML that the browser receives.</p>
            </article>
            <article>
                <h2>Where the account data comes from</h2>
                <p>The Customer Accounts and User Accounts pages use CodeIgniter Models to retrieve records from MySQL. The views still loop through the result sets with foreach, preserving the clear display pattern used by the original array-based version.</p>
            </article>
            <article>
                <h2>What this version adds</h2>
                <p>The project includes migrations, seed data, and a portable SQL export so the database can be created consistently for local development or deployment.</p>
            </article>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
