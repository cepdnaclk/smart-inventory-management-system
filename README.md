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

-   [Nuwan Jaliyagoda](http://github.com/NuwanJ)

### Sprint 2A

-   [Tharmapalan Thanujan](http://github.com/thanujan96)
-   [Madhushan Ramalingam](https://github.com/DrMadhushan)
-   [Thilini Madushani](http://github.com/Thilini98)

### Sprint 3A

-   [Ishan Fernando](https://github.com/ishanfdo18098)
-   [Adeepa Fernando](https://github.com/NipunFernando)
-   [Ridma Jayasundara ](https://github.com/ridmajayasundara)

### Sprint 3B

-   [Sadia Jameel](https://github.com/SaadiaJameel)
-   [Sakuni Nimnadi](https://github.com/SakuniJayasinghe)
-   [Thamish Wanduragala](https://github.com/Thamish99)

### Sprint 3C

-   [Karan R.](https://github.com/rasathuraikaran)
-   [Gowsigan A.](https://github.com/AnnalingamGowsigan)
-   [Muthuni De Alwis](https://github.com/muthuni-dealwis)

## Useful Commands and Instructions

You need to install Wamp server and run it before following commands.
Please make sure you already created database user account.

#### Install Dependencies

```
// Install PHP dependencies
composer install

// If you received mmap() error, use this command
// php -d memory_limit=-1 /usr/local/bin/composer install

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

// Prepare webhook for unit testing
git config --local core.hooksPath .githooks

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

#### Run all above commands from bash script

```
// Enable execution of bash script (for Linux)
chmod +x Start.sh

// Run bash script
./Start.sh
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

// Run unit tests in parallel
php artisan test -p

```

#### Resource Routes

| Verb      | URI                             | Action  | Route Name             |
| :-------- | :------------------------------ | :------ | :--------------------- |
| GET       | /photos/{photo}/comments        | index   | photos.comments.index  |
| GET       | /photos/{photo}/comments/create | create  | photos.comments.create |
| POST      | /photos/{photo}/comments        | store   | photos.comments.store  |
| GET       | /comments/{comment}             | show    | comments.show          |
| GET       | /comments/{comment}/edit        | edit    | comments.edit          |
| PUT/PATCH | /comments/{comment}             | update  | comments.update        |
| DELETE    | /comments/{comment}             | destroy | comments.destroy       |
