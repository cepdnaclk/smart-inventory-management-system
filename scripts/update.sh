#!/bin/sh

# Update PHP dependencies
composer update

# Update NodeJS dependencies and compile
npm install
npm run dev

# Migrate the DB into latest status
php artisan migrate
