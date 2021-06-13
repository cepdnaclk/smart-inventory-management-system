# Smart Inventory Management System

Smart Inventory Management System for Department MakerSpace Lab

## Team of Developers 
- [Nuwan Jaliyagoda](http://github.com/NuwanJ)
- [Tharmapalan Thanujan](http://github.com/thanujan96)
- [Madhushan Ramalingam](https://github.com/DrMadhushan)
- [Thilini Madushani](http://github.com/Thilini98)

This is old 

## Useful Commands and Instructions

You need to install Wamp server and run it before following commands.

#### Install Dependencies
```
// Install PHP dependencies
composer install

// Install Node dependencies (development mode)
npm install
npm run development
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

```
