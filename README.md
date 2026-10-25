# Laravel To-Do List (course demo)

## Setup

```bash
composer create-project laravel/laravel todo-app
cd todo-app
```

Copy everything from this folder into `todo-app` (say yes to overwrite), then:

```bash
php artisan migrate --seed
php artisan serve
```

Open http://127.0.0.1:8000 and log in with `test@example.com` / `password`.

Laravel uses SQLite by default (no setup). For MySQL, change `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=
```

Create the `todo_app` database first, then run `php artisan migrate --seed`.

## Files that replace Laravel defaults

`routes/web.php`, `bootstrap/app.php`, `app/Models/User.php`, `database/seeders/DatabaseSeeder.php`

## Where each chapter appears

| Chapter | Where to see it |
|---|---|
| 1. Introduction | Request flow: `routes/web.php` -> `TaskController` -> view |
| 2. Installation / structure | Setup above, `php artisan route:list` |
| 3. Routes and controllers | `routes/web.php`, `TaskController`, `compact(...)` passes data to views |
| 4. Views and Blade | `layouts/app.blade.php`, `@extends`, `@yield`, `@forelse`, `@if`, `@include` |
| 5. Database / migrations | `database/migrations/*`, `DatabaseSeeder`, `TaskFactory` |
| 6. Eloquent | `Task`, `Category`, `User` models and relationships; CRUD in `TaskController` |
| 7. Forms and validation | `tasks/_form.blade.php`, `validated()` in `TaskController`, GET filters in `tasks/index` |
| 8. Auth and middleware | `AuthController`, `guest` / `auth` groups, `EnsureTaskOwner` |
| 9. Useful features | Named routes, `redirect()->route()`, flash messages, file upload with `Storage`, `try/catch`, 403/404 pages |
| 10. Mini-project | The whole app |
