# TFA3: Forms, validation, and file upload

This update extends the CodeIgniter POS activity with database-backed create and edit workflows.

## Included work

- Create and edit customer records at `/customers/new` and `/customers/{id}/edit`.
- Create and edit user records at `/users/new` and `/users/{id}/edit`.
- Server-side validation for required customer and user fields, valid email addresses, and unique usernames.
- Optional user profile-photo upload on the user edit screen. The application accepts JPG/PNG files up to 2 MB, prepares a 300 x 300 display image, and saves only its generated filename in the database.
- Avatar placeholders for users without a saved photo.
- A database migration adding the nullable `avatar` column to the `users` table.

## Local setup

1. Ensure Apache/MySQL is running in XAMPP.
2. Import `database/codeigniter_pos.sql` in phpMyAdmin **or**, if the TFA2 database already exists, run this from the project folder:

   ```powershell
   & 'C:\xampp\php\php.exe' -d extension=intl spark migrate
   ```

3. Start the application:

   ```powershell
   & 'C:\xampp\php\php.exe' -d extension=intl spark serve --port 8081
   ```

4. Open `http://localhost:8081/customers` or `http://localhost:8081/users`.

The web server must be allowed to write to `public/uploads/avatars`. Do not store the image itself in MySQL; only its filename belongs in `users.avatar`.
