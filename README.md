# Laravel Posts/Auth Demo

Mini Laravel app with user registration/login/logout and posts CRUD.

## Stack

-   Laravel 11, PHP 8.x
-   SQLite (default)

## Setup

```bash
cp .env.example .env
php artisan key:generate
# Ensure database/database.sqlite exists
php artisan migrate
php artisan serve
```

## Features

-   Register, login, logout (session regeneration)
-   Create, edit, delete posts (ownership checks)
-   Basic Blade views and routes

## Routes

-   POST /register
-   POST /login
-   POST /logout
-   POST /create-post
-   GET /edit-post/{post}
-   PUT /edit-post/{post}
-   DELETE /delete-post/{post}
