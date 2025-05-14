# 🌐 Osirisgate Core Exception Library

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-%3E=8.2-8892BF.svg)](https://www.php.net/releases/8.2/)

> Osirisgate core exception library provides robust and extensible exception handling utilities based on typed HTTP status codes, built with modern PHP. Designed for extensibility.

---

## 📦 Installation

```bash
composer require osirisgate/core
````

## ✅ Requirements

- PHP 8.2 or higher

## ✨ Features

* Typed custom exceptions with HTTP status codes
* `StatusCode` enum based on [RFC 9110](https://www.rfc-editor.org/rfc/rfc9110)
* Interface and trait for consistent error formatting
* Utility methods for API responses and logging
* PSR-4 autoloading


## 🧱 Project Structure

```
src/
├── Enum/
│   └── Enum.php
│   └── StatusCode.php
├── Exception/
│   ├── Exception.php
│   ├── ExceptionInterface.php
│   └── Trait/
│       └── ExceptionFormatter.php
tests/
└── Exception/
    └── RuntimeExceptionTest.php
```

## 🧑‍💻 Basic Usage

### 1. Create a custom exception

```php
use Osirisgate\Core\Exception\Exception;
use Osirisgate\Core\Enum\StatusCode;

final class ResourceNotFoundException extends Exception
{
    protected StatusCode $statusCode = StatusCode::NOT_FOUND;
}
```

### 2. Trigger an exception into your code

You can throw your custom exception like this:

```php
throw new ResourceNotFoundException([
    'message' => 'The requested resource was not found.',
    'details' => [
        'resource' => 'user',
        'id' => 123
    ]
]);
```

### 3. Retrieve exception data

You can catch the exception and access structured error data like so:

```php
use Osirisgate\Core\Exception\ExceptionInterface;

try {
    throw new ResourceNotFoundException([
        'message' => 'The requested resource was not found.',
        'details' => [
            'resource' => 'user',
            'id' => 123
        ]
    ]);
} catch (ExceptionInterface $e) {
    echo $e->getMessage(); // The requested resource was not found.
    echo $e->getCode(); // 404

    print_r($e->getErrors());
    /*
    [
        'details' => [
            'resource' => 'user',
            'id' => 123
        ]
    ]
    */
    
    print_r($e->getDetails());
    /*
    [
        'resource' => 'user',
        'id' => 123
    ]
    */

    print_r($e->format());
    /*
    [
        'status' => 'error',
        'error_code' => 404,
        'message' => 'The requested resource was not found.',
        'details' => [
            'resource' => 'user',
            'id' => 123
        ]
    ]
    */
}
```

## 🧪 Example outputs

```php
$exception = new RuntimeException([
    'message' => 'error message',
    'details' => [
        'error' => 'error details',
        'key' => 'value'
    ]
]);
```

### 🔸 `getMessage()`

```php
$exception->getMessage();
// Output: 'error message'
```

### 🔸 `getCode()`

```php
$exception->getCode();
// Output: 500
```

### 🔸 `getErrors()`

```php
$exception->getErrors();
/*
[
    'details' => [
        'error' => 'error details',
        'key' => 'value'
    ]
]
*/
```

### 🔸 `getDetails()`

```php
$exception->getDetails();
/*
[
    'error' => 'error details',
    'key' => 'value'
]
*/
```

### 🔸 `getDetailsMessage()`

```php
$exception->getDetailsMessage();
// Output: 'error details'
```

### 🔸 `getErrorsForLog()`

```php
$exception->getErrorsForLog();
/*
[
    'message' => 'error message',
    'error_code' => 500,
    'errors' => [
        'details' => [
            'error' => 'error details',
            'key' => 'value'
        ]
    ],
    'file' => '/path/to/file.php',
    'line' => 123,
    'previous' => null,
    'trace_as_array' => [...],
    'trace_as_string' => 'stack trace...'
]
*/
```

### 🔸 `format()`

The trait `ExceptionFormatter` returns a structured response:

```php
$exception->format();
/*
[
    'status' => 'error',
    'error_code' => 500,
    'message' => 'error message',
    'details' => [
        'error' => 'error details',
        'key' => 'value'
    ]
]
*/
```

## 🧪 Run Tests

```bash
vendor/bin/phpunit tests
```

## 🧰 Developer tools

### Fix code style:

```bash
composer run phpcs-fix
```

### Run static analysis:

```bash
composer run phpstan
```

Or run both commands via make:

```bash
make check-code-quality
```

## 📜 License

This package is licensed under the [MIT License](LICENSE).

## 👤 Author

**Ulrich Geraud AHOGLA** | Software Engineer

For any questions or feedback, please contact me at [developer@osirisgate.com](mailto:developer@osirisgate.com)
