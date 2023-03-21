# Laravel 8 - Task Manager

## What You Need

-   A favorite text editor or IDE
-   PHP >= 7.3
-   Composer
-   Node.js
-   Npm

## Setup Project

cd ManagerTask
php artisan serve

```

#### Configure Database Connection

go to you `.env` file & update the database variables

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= #you_database_name
DB_USERNAME= #your_username
DB_PASSWORD= #your_password

```

#### Finalizing The Installation

```

cd ManagerTask
npm install
npm run dev
php artisan migrate
php artisan serve

```

```
