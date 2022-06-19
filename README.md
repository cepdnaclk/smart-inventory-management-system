[![Build](https://github.com/cepdnaclk/smart-inventory-management-system/actions/workflows/laravel.yml/badge.svg)](https://github.com/cepdnaclk/smart-inventory-management-system/actions/workflows/laravel.yml)

# Smart Inventory Management System

Smart Inventory Management System for Department MakerSpace Lab

### Demo Credentials

**Admin:** admin@example.com  
**Password:** admin_user

**User:** user@example.com  
**Password:** regular_user

**User:** lecturer@example.com  
**Password:** lecturer_user

### Introduction

Laravel Boilerplate provides you with a massive head start on any size web application. Out of the box it has features like a backend built on CoreUI with Spatie/Permission authorization. It has a frontend scaffold built on Bootstrap 4. Other features such as Two Factor Authentication, User/Role management, searchable/sortable tables built on my [Laravel Livewire tables plugin](https://github.com/rappasoft/laravel-livewire-tables), user impersonation, timezone support, multi-lingual support with 20+ built in languages, demo mode, and much more.

[Click here for the official documentation](http://laravel-boilerplate.com)

## Team of Developers
- [Nuwan Jaliyagoda](http://github.com/NuwanJ)
- [Tharmapalan Thanujan](http://github.com/thanujan96)
- [Madhushan Ramalingam](https://github.com/DrMadhushan)
- [Thilini Madushani](http://github.com/Thilini98)


## Useful Commands and Instructions

You need to install Wamp server and run it before following commands.
Please make sure you already created database user account.

#### Install Dependencies
```
// Install PHP dependencies
composer install

// Update PHP dependencies
composer update

// Install Node dependencies (development mode)
npm install
npm run dev
```

#### Prepare for the first run

```
// Prepare the public link for storage
php artisan storage:link

// Prepare the database
php artisan migrate

// Reset the database and seed the data
php artisan migrate:fresh --seed

```

#### Serve in the local environment

```
// Serve PHP web server
php artisan serve

// Serve PHP web server, in a specific IP & port
php artisan serve --host=0.0.0.0 --port=8000

// To work with Vue components
npm run watch
```

#### Cache and optimization
```
// Remove dev dependencies
composer install --optimize-autoloader --no-dev

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### Maintenance related commands  
```
php artisan down --message="{Message}" --retry=60
php artisan up
```

#### Other useful instructions

```
// Create Model, Controller and Database Seeder
php artisan make:model {name} --migration --controller --seed

// Create a Email
php artisan make:mail -m

// Commandline interface for Database Operations
php artisan tinker

// Run the unit tests
php artisan test

```

#### Resource Routes

|Verb	|URI	|Action	|Route Name |
|:------|:------|:------|:----------|
|GET	|/photos/{photo}/comments	|index	|photos.comments.index|
|GET	|/photos/{photo}/comments/create	|create	|photos.comments.create
|POST	|/photos/{photo}/comments	|store	|photos.comments.store
|GET	|/comments/{comment}	|show	|comments.show
|GET	|/comments/{comment}/edit	|edit	|comments.edit
|PUT/PATCH	|/comments/{comment}	|update	|comments.update
|DELETE	|/comments/{comment}	|destroy	|comments.destroy
