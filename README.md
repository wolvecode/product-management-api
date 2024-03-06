# product-management-api

## Setup

### Dependencies

-   PHP >= 8.1
-   Composer
-   MySQL (or any other compatible database)
-   Redis (for caching)

### Installation

1. Clone the repository:

    ```
    git clone git@github.com:wolvecode/product-management-api.git
    ```

2. Install PHP dependencies:

    ```
    composer install
    ```

3. Copy the `.env.example` file to `.env`:

    ```
    cp .env.example .env
    ```

4. Generate an application key:

    ```
    php artisan key:generate
    ```

5. Configure your database connection in the `.env` file.

6. Run database migrations:

    ```
    php artisan migrate
    ```
7. To seed database (optional):

    ```
    php artisan db:seed
    ```

### Running the Application

1. Serve the application locally:

    ```
    php artisan serve
    ```

2. Access the application in your web browser at `http://localhost:8000`.

### Testing

1. Run unit tests:

    ```
    php artisan test
    ```

## License

This project is open-source and available under the [MIT License](LICENSE).
