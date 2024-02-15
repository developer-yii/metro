# Laravel Project Setup Guide

This document outlines the steps necessary to set up this Laravel project. 

## Getting Started

Follow these steps to get your development environment up and running.

### Prerequisites

- PHP >= 7.3
- Composer
- MySQL or another database system

### Step 1: Composer Update

Run Composer to install or update dependencies:

```bash
composer update

### Step 2: Environment Configuration
    Copy .env.example to a new file named .env.
    Edit .env to configure your database settings:

    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

### Step 3: Database Migrations
    Run the following command to create the database tables:

    php artisan migrate

### Step 4: Database Seeding (Optional)
    To seed the database with initial data, run:
    php artisan db:seed

    For a specific seeder:
    php artisan db:seed --class=YourSeederClassName

### Step 5: Default User
    The default user created (if using provided seeders):

    Email: admin@gmail.com
    Password: 12345678

### Step 6: Symbolic Link for Storage
    Create a symbolic link for storage:
    php artisan storage:link
    This command links public/storage to storage/app/public for public file access.

"# metro" 
