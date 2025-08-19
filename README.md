# User Management System with Livewire

This is a user management system built with Laravel and Livewire. It provides a starting point for applications requiring user authentication, role-based access control, and a modular architecture.

## Features

*   **User Management:** CRUD operations for users.
*   **Role-Based Access Control (RBAC):** Assign roles and permissions to users.
*   **Modular Architecture:** The application is divided into modules, making it easy to extend and maintain.
*   **Authentication:** Secure user authentication.
*   **Livewire:** A full-stack framework for Laravel that makes building dynamic interfaces simple.

## Tech Stack

*   [Laravel](https://laravel.com/)
*   [Livewire](https://livewire.laravel.com/)
*   [Volt](https://livewire.laravel.com/docs/volt)
*   [nwidart/laravel-modules](https://nwidart.com/laravel-modules/v6/introduction)
*   [Tailwind CSS](https://tailwindcss.com/)
*   [Vite](https://vitejs.dev/)

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Set up your environment:**
    ```bash
    cp .env.example .env
    ```
    *Update your database credentials in the `.env` file.*


4.  **Run database migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```

5.  **Build assets and run the development server:**
    ```bash
    npm run dev
    ```
    In a separate terminal, run:
    ```bash
    php artisan serve
    ```

## Modules

This project uses the `nwidart/laravel-modules` package to organize code into modules. The `Blog` module is included as an example. You can create new modules by running:

```bash
php artisan module:make NewModuleName
```


