<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

# Laravel Blogging Platform

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. It simplifies common tasks used in many web projects, including:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Overview

This is a Laravel-based blogging platform that provides users with the following features:

- **User Authentication**: Secure user registration, login, password reset, and profile management.
- **Post Management**: Create, view, edit, and delete blog posts. Posts can be soft deleted and restored.
- **Comment System**: Users can comment on posts and delete their own comments.
- **Pagination**: Efficiently display posts with pagination.
- **Profile Management**: Users can set a default profile image or upload a custom image.

## Features

- **User Authentication**:
  - Register and login users.
  - Forgot password functionality with email notifications.
  - Email notifications on successful registration.

- **Post Management**:
  - View all posts or filter by user-specific posts.
  - Display active posts and soft-deleted posts with options to restore or permanently delete.
  - Edit and delete posts based on user permissions.

- **Comment System**:
  - Add comments to posts.
  - Delete their own comments.

- **Pagination**:
  - Paginate posts with a default limit of 10 posts per page.

- **Profile Management**:
  - Default profile image and the ability to upload a custom image.

## Installation

### Prerequisites

- PHP 8.0 or higher
- Composer
- MySQL or any other compatible database

### Clone the Repository

```bash
git clone *
cd *
```

### Install Dependencies

```bash
composer install
```

### Set Up Environment

1. Copy `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Generate an application key:

    ```bash
    php artisan key:generate
    ```

3. Configure your database connection in `.env`:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

4. Set up mail configuration for email notifications in `.env`:

    ```
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=example@example.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```

### Run Migrations and Seeders

Run the migrations to set up the database schema:

```bash
php artisan migrate
```

Seed the database with initial data:

```bash
php artisan db:seed
```

### Serve the Application

Start the development server:

```bash
php artisan serve
```

Open your browser and visit `http://localhost:8000` to view the application.

## Usage

1. **Register/Login**: Create an account or log in to access the blogging features. Use the "Forgot Password" link to reset your password if needed.
2. **Create Posts**: Use the "Add Post" button to create new blog posts.
3. **View Posts**: Browse through posts and read their content.
4. **Edit/Delete Posts**: Modify or remove posts if you are the author or an admin.
5. **Manage Deleted Posts**: Access and restore soft-deleted posts if needed.
6. **Comment on Posts**: Add comments to posts and delete your own comments.
7. **Profile Management**: Set or update your profile image.

## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch for your changes.
3. Commit your changes and push to your fork.
4. Open a pull request with a description of your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Acknowledgments

- Laravel Framework
- Bootstrap for UI components

## Contact

For any questions or issues, please contact on any if the provided social account.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.
