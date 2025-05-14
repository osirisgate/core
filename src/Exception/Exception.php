<?php

declare(strict_types=1);

namespace Osirisgate\Core\Exception;

use Osirisgate\Core\Enum\StatusCode;
use Osirisgate\Core\Exception\Trait\ExceptionFormatter;

abstract class Exception extends \Exception implements ExceptionInterface
{
    use ExceptionFormatter;

    /**
     * Exception status code.
     *
     * @var StatusCode The status code
     */
    protected StatusCode $statusCode = StatusCode::BAD_REQUEST;

    /**
     * Custom data into the exception.
     *
     * @var array<string, mixed>
     */
    protected array $errors;

    /**
     * @param array<string, mixed> $errors
     */
    public function __construct(array $errors)
    {
        /** @var string $message */
        $message = $errors['message'] ?? $this->statusCode->getDescription();
        parent::__construct(
            message: $message,
            code: $this->statusCode->getValue(),
        );
        unset($errors['message']);
        $this->errors = $errors;
    }

    /**
     * Get custom exception errors.
     *
     * @return array<string, mixed>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get custom exception errors details.
     *
     * @return array<string, mixed>
     */
    public function getDetails(): array
    {
        /** @var array<string, mixed> $details */
        $details = $this->errors['details'] ?? [];

        return $details;
    }

    /**
     * Get custom exception errors details message.
     */
    public function getDetailsMessage(): string
    {
        /** @var string $error */
        $error = $this->getDetails()['error'] ?? '';

        return $error;
    }

    /**
     * Get exception errors for logs.
     *
     * @return array<string, mixed>
     */
    public function getErrorsForLog(): array
    {
        return [
            'message' => $this->getMessage(),
            'error_code' => $this->getCode(),
            'errors' => $this->errors,
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'previous' => $this->getPrevious(),
            'trace_as_array' => $this->getTrace(),
            'trace_as_string' => $this->getTraceAsString(),
        ];
    }
}
