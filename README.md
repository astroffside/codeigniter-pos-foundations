# CodeIgniter POS Database Activity

A CodeIgniter 4 Point-of-Sale application for IT0049 Technical Formative Assessment 2. It replaces the starter project's controller-local arrays with a MySQL database while keeping the customer and user account pages focused and easy to use.

## Required pages

| URL | Controller | Purpose |
| --- | --- | --- |
| / | Pages::index | POS landing page |
| /about | Pages::about | Activity and MVC overview |
| /customers | Customers::index | Customer Accounts listing |
| /users | Users::index | User Accounts listing |

Customer Accounts and User Accounts retrieve their records through CodeIgniter Models and Query Builder methods. Their views use foreach loops to render the database result sets.

## Assignment requirements completed

- MySQL customers and users tables that match the supplied schema.
- CustomerModel and UserModel classes that back the two account pages.
- At least five seeded records in each table.
- CodeIgniter migrations and seeders for repeatable setup.
- A portable SQL database export at database/codeigniter_pos.sql.
- Automated feature coverage for the four required routes.

## Local setup and run

### Prerequisites

- PHP 8.2 or later with intl, mbstring, and mysqli enabled.
- MySQL 8+ or MariaDB 10.4+.
- Composer, only when vendor dependencies are not already installed.

1. Install dependencies when needed:

       composer install

2. Create the local environment file:

       Copy-Item .env.example .env

3. Set the database connection in .env. For a default local XAMPP installation, use:

       database.default.hostname = 127.0.0.1
       database.default.database = codeigniter_pos
       database.default.username = root
       database.default.password =
       database.default.DBDriver = MySQLi
       database.default.port = 3306

4. Choose one database setup method:

   - Import the included database export. It creates the database, tables, and sample data:

         mysql -u root -p < database/codeigniter_pos.sql

   - Or create an empty codeigniter_pos database, then run the CodeIgniter migration and seeders:

         php spark migrate
         php spark db:seed PosSeeder

   Do not run the migration/seed commands against a database that was already imported from the SQL export.

5. Start the application:

       php spark serve

6. Open http://localhost:8080/ in a browser.

For XAMPP where intl is not enabled by default, use:

    C:\xampp\php\php.exe -d extension=intl -S 127.0.0.1:8080 -t public vendor\codeigniter4\framework\system\rewrite.php

## Verification

Run the automated route checks:

    php vendor/bin/phpunit --configuration phpunit.dist.xml --no-coverage

Or inspect the routes:

    php spark routes

On the supplied XAMPP PHP installation, run the test suite with its required extensions temporarily enabled:

    C:\xampp\php\php.exe -d extension=intl -d extension=sqlite3 vendor\bin\phpunit --configuration phpunit.dist.xml --no-coverage

## Database contents

The export and the seeders create the following records:

| Table | Fields | Sample records |
| --- | --- | --- |
| customers | id, full_name, email, phone, created_at | 5 |
| users | id, username, full_name, created_at | 5 |

The customers.phone field is nullable, and users.username is unique. The activity schema intentionally does not include a role or password field for users.

## Deployment notes

1. Install the same project files and Composer dependencies on a PHP 8.2+ host.
2. Create a production .env file with CI_ENVIRONMENT = production, the real HTTPS app.baseURL, and the host's MySQL credentials.
3. Import database/codeigniter_pos.sql once, or run the migration and PosSeeder once against an empty production database.
4. Set the web host document root to the public directory and enable rewrite rules.

Do not commit the production .env file. It is excluded by .gitignore so database credentials remain local to each environment.

## Submission checklist

- Push this folder's raw project files, including database/codeigniter_pos.sql, to a GitHub repository.
- Deploy the same project to a PHP-compatible host whose document root is the public folder.
- Add the GitHub repository URL and the live application URL to the course submission.
