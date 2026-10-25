# Tasks for Today Management System in Laravel

Complete IT0049 TSA3 project. Welcome (`/`) shows tasks scheduled **today**; Task List (`/tasks`) shows every task ordered by date; Profile (`/profile`) reads the single user from the database; About (`/about`) identifies John Xavier Tumbokon as developer. Eloquent models retrieve the data; Blade views display it. Data is fictional, including `student@example.com`, which you can replace in the user seeder before submitting.

The date seeder creates 9 tasks over 6 different dates, with 4 assigned to today when you run it, and exactly 1 user. The application uses Laravel 12 for PHP 8.2 compatibility. No Node.js or npm is needed; CSS is already in `public/css/app.css`.

## Run locally in VS Code

1. Extract `tasks-for-today-tsa3.zip` to a **new folder** and open `tasks-for-today-tsa3` in VS Code. Do not copy its files into your TFA5 or TFA6 folder.
2. Select **Terminal > New Terminal**, then choose **Command Prompt** in the terminal dropdown. If PHP says it is not recognized and you have XAMPP at `C:\xampp`, type:

   ```bat
   set "PATH=C:\xampp\php;%PATH%"
   php -v
   composer --version
   ```

   In a **PowerShell** terminal, use `$env:Path = "C:\xampp\php;$env:Path"` instead of the `set` line. The installation requires PHP 8.2+, Composer, and PDO SQLite for local SQLite.
3. Run each command in the opened project directory:

   ```bat
   composer install
   copy .env.example .env
   php artisan key:generate
   php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
   php artisan migrate --seed
   php artisan serve
   ```

   Or run `setup.bat` once, followed by `start.bat`, from the project directory. The batch files find `C:\xampp\php` if PHP is missing from PATH. If `.env` already exists, skip the `copy` line. Never run `migrate:fresh` on a database containing work you need to keep; it deletes tables.
4. Visit `http://127.0.0.1:8000`. Check `/` (4 tasks for today immediately after seeding), `/tasks` (9 tasks), `/profile` (1 user), and `/about`. If you revisit on a later date, Welcome changes naturally. To refresh example tasks relative to the new date, run `php artisan db:seed`.
5. In another terminal you can check `php artisan migrate:status`, `php artisan route:list --except-vendor`, and `php artisan test`. PHP's `pdo_sqlite` extension is needed for SQLite and the tests; run `php --ini` to locate `php.ini` if a driver is missing.

### Use XAMPP MySQL locally instead

Start MySQL in XAMPP. Create a **new, empty** database called `tasks_for_today_tsa3` in phpMyAdmin. Edit `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasks_for_today_tsa3
DB_USERNAME=root
DB_PASSWORD=
```

Run `php artisan config:clear` and `php artisan migrate --seed`. Use your actual local database credentials. Do not import `hosting_mysql.sql` into a database that has already run these migrations.

## Where the required work is

| Requirement | File and behavior |
| --- | --- |
| Task schema | `database/migrations/2026_10_25_000001_create_tasks_table.php` creates `title`, `status` default `pending`, `task_date`, and timestamps. |
| User schema | `database/migrations/0001_01_01_000000_create_users_table.php` creates unique `username`, `full_name`, `email`, and timestamps. |
| Seed data | `database/seeders/TaskSeeder.php` creates 9 tasks across dates relative to today. `UserSeeder.php` creates one user. `DatabaseSeeder.php` calls both. |
| Eloquent layer | `app/Models/Task.php` and `User.php` represent the two tables. |
| Routes and controllers | `routes/web.php`, `TaskController.php`, `ProfileController.php`, and `PageController.php` connect all four pages. |
| Blade views | `resources/views/welcome.blade.php`, `tasks/index.blade.php`, `profile.blade.php`, and `about.blade.php` share `layouts/app.blade.php`. |

The Welcome controller uses `whereDate('task_date', today())`; Task List orders every record by `task_date`. The user profile reads the record from the database. These are Eloquent queries, not static task arrays in the views.

## Host on InfinityFree step by step

TSA3 requires a hosted link and a GitHub repository link. Set up a **separate hosting website/subdomain** so you do not replace your TFA5 or TFA6 site. InfinityFree does not let you change `htdocs` to Laravel's `public` folder or run Artisan on its server; this project includes a database import and rewrite file for those limits. See [InfinityFree's Laravel guide](https://forum.infinityfree.com/t/how-to-install-a-laravel-site-on-infinityfree/118578).

1. Create a new InfinityFree hosting account/site. In its control panel create a **new MySQL database**. Open that database in phpMyAdmin, choose **Import**, and select `database/hosting_mysql.sql`. Import **once into the empty database**. It creates both tables, nine tasks dated relative to the date of import in Philippine time, and one user. Keep the shown database hostname, name, username, and password; its host is usually not `localhost`.
2. Prepare a **separate upload copy** of the project on your computer. Open Command Prompt in that copy, install production dependencies with `composer install --no-dev`, make `.env` from `.env.example` if needed, and run `php artisan key:generate`. If you made `.env` already, keep the generated APP_KEY. Run `php artisan optimize:clear` before upload so local paths are not cached. Do not run local SQLite migrations to fill the hosted MySQL database; the SQL import did that.
3. In the **deployment copy's** `.env`, set the real values:

   ```dotenv
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-actual-domain
   DB_CONNECTION=mysql
   DB_HOST=your-actual-mysql-host
   DB_PORT=3306
   DB_DATABASE=your-actual-database-name
   DB_USERNAME=your-actual-database-user
   DB_PASSWORD=your-actual-database-password
   SESSION_DRIVER=file
   CACHE_STORE=file
   QUEUE_CONNECTION=sync
   ```

   Keep the generated `APP_KEY`. Enter your real `APP_URL` with `https://` when SSL is active. Do not post your database password publicly.
4. In FileZilla, open **that site's `htdocs`**. Upload the **contents** of the deployment project: `app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `storage`, `vendor`, `artisan`, `composer.json`, and `.env`. Confirm `htdocs/public/index.php` exists. Make sure FileZilla displays hidden files like `.env` and `.htaccess`. Do not upload the ZIP as the only file.
5. Copy `deployment/htdocs.htaccess` to `htdocs/.htaccess` (rename it to `.htaccess`). Keep `public/.htaccess` and `public/index.php` as supplied. The two files route requests through Laravel's `public` folder.
6. Check the live `/`, `/tasks`, `/profile`, and `/about` URLs. On the import day Welcome shows four tasks; `/tasks` shows nine. On later days Welcome shows only tasks with that later date, or its empty message if no task was seeded for the date. To refresh sample dates on a host without Artisan, update task dates in phpMyAdmin or export new sample SQL and reimport into a new database.

## GitHub and submission

Create a repository and upload the **raw Laravel project files**, including both migration files and seeders. Commit `composer.lock` generated by Composer. Include `README.md`, `composer.json`, `artisan`, the app, routes, database, views, and public assets. The `vendor` folder, `.env`, and local `database/database.sqlite` stay out of GitHub. The included `.gitignore` excludes them. Your professor needs two actual links: the repository and the live site. Uploading code to GitHub alone does not host PHP.

PHP and Composer were unavailable in the project creation workspace. The code, route/view references, and seed data were checked statically, but the server and tests must be run on your Windows computer before submission.
