<?php

declare(strict_types=1);

namespace Osirisgate\Core\Tests;

use Osirisgate\Core\Enum\Status;
use Osirisgate\Core\Enum\StatusCode;
use Osirisgate\Core\Exception\RuntimeException;
use PHPUnit\Framework\TestCase;

final class RuntimeExceptionTest extends TestCase
{
    public function testRuntimeExceptionFormat(): void
    {
        $message = 'error message';
        $errorDetails = [
            'key' => 'value'
        ];
        $exception = new RuntimeException([
            'message' => $message,
            'details' => $errorDetails
        ]);

        $exceptionFormatted = $exception->format();

        self::assertEquals(Status::ERROR->getValue(), $exceptionFormatted['status']);
        self::assertEquals(StatusCode::INTERNAL_SERVER_ERROR->getValue(), $exceptionFormatted['error_code']);
        self::assertEquals($message, $exceptionFormatted['message']);
        self::assertEquals($errorDetails, $exceptionFormatted['details']);
    }

    public function testRuntimeExceptionMessage(): void
    {
        $message = 'error message';
        $errorDetails = [
            'error' => 'error details'
        ];
        $exception = new RuntimeException([
            'message' => $message,
            'details' => $errorDetails
        ]);

        self::assertEquals($message, $exception->getMessage());
    }

    public function testRuntimeExceptionCode(): void
    {
        $message = 'error message';
        $errorDetails = [
            'error' => 'error details'
        ];
        $exception = new RuntimeException([
            'message' => $message,
            'details' => $errorDetails
        ]);

        self::assertEquals(StatusCode::INTERNAL_SERVER_ERROR->getValue(), $exception->getCode());
    }

    public function testRuntimeExceptionDetails(): void
    {
        $message = 'error message';
        $errorDetails = [
            'key' => 'value'
        ];
        $exception = new RuntimeException([
            'message' => $message,
            'details' => $errorDetails
        ]);

        self::assertEquals($errorDetails, $exception->getDetails());
    }

    public function testRuntimeExceptionDetailMessage(): void
    {
        $message = 'error message';
        $errorDetails = [
            'error' => 'error details'
        ];
        $exception = new RuntimeException([
            'message' => $message,
            'details' => $errorDetails
        ]);

        self::assertEquals('error details', $exception->getDetailsMessage());
    }

    public function testRuntimeExceptionErrors(): void
    {
        $message = 'error message';
        $errorDetails = [
            'error' => 'error details'
        ];
        $exception = new RuntimeException([
            'message' => $message,
            'details' => $errorDetails
        ]);

        self::assertEquals([
            'details' => $errorDetails
        ], $exception->getErrors());
    }

    public function testRuntimeExceptionErrorsForLog(): void
    {
        $exception = new RuntimeException([
            'message' => 'error message',
            'details' => [
                'key' => 'value'
            ]
        ]);

        $errorsForLog = $exception->getErrorsForLog();
        self::assertArrayHasKey('message', $errorsForLog);
        self::assertArrayHasKey('error_code', $errorsForLog);
        self::assertArrayHasKey('errors', $errorsForLog);
        self::assertArrayHasKey('file', $errorsForLog);
        self::assertArrayHasKey('line', $errorsForLog);
        self::assertArrayHasKey('previous', $errorsForLog);
        self::assertArrayHasKey('trace_as_array', $errorsForLog);
        self::assertArrayHasKey('trace_as_string', $errorsForLog);
    }
}