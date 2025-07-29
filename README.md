# Lite-Slim

A lightweight, fast, and flexible web development framework based on PHP Slim.

## Features

*   **Slim Framework:** Built on the powerful and minimalist Slim micro-framework.
*   **Dependency Injection:** Uses PHP-DI for managing dependencies, promoting clean and testable code.
*   **Environment-based Configuration:** Manages configuration using `.env` files for different environments.
*   **Logging:** Integrated with Monolog for robust logging.
*   **Templating:** Supports server-side rendering with `slim/php-view`.
*   **Session Management:** Includes session support via `bryanjhv/slim-session`.
*   **JWT Authentication:** Ready for token-based authentication with `firebase/php-jwt`.

## Requirements

*   PHP >= 8.1
*   Composer

## Installation

1.  **Clone the repository:**
    ```bash
    git clone <your-repository-url> lite-slim
    cd lite-slim
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    ```

3.  **Set up environment variables:**
    ```bash
    cp .env.example .env
    ```
    Then, edit the `.env` file with your specific settings (e.g., database credentials, app keys).

4.  **Configure your web server** (e.g., Nginx or Apache) to point to the `public` directory as the document root.

## Project Structure

```
lite-slim/
├── config/          # Configuration files
├── logs/            # Log files
├── public/          # Publicly accessible files (index.php)
├── src/             # Application source code
├── templates/       # View templates
├── vendor/          # Composer dependencies
├── .env             # Environment variables
├── composer.json    # Project dependencies
└── README.md        # This file
```

## Getting Started

Define your routes and application logic in the `src` directory. The main application entry point is `public/index.php`.

**Example Route:**

```php
// In your routes file

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});
```

## Contributing

Contributions are welcome! Please feel free to submit a pull request.

1.  Fork the repository.
2.  Create your feature branch (`git checkout -b feature/your-feature`).
3.  Commit your changes (`git commit -m 'Add some feature'`).
4.  Push to the branch (`git push origin feature/your-feature`).
5.  Open a pull request.

## License

This project is licensed under the MIT License.
