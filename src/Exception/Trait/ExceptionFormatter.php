<?php

declare(strict_types=1);

namespace Osirisgate\Core\Exception\Trait;

use Osirisgate\Core\Enum\Status;

trait ExceptionFormatter
{
    /**
     * Format exception as array.
     *
     * @return array<string, mixed>
     */
    public function format(): array
    {
        return [
            'status' => Status::ERROR->value,
            'error_code' => $this->getCode(),
            'message' => $this->getMessage(),
        ] + $this->getErrors();
    }

    /**
     * Get custom exception errors.
     *
     * @return array<string, mixed>
     */
    abstract public function getErrors(): array;

    /**
     * Get exception status code.
     */
    abstract public function getCode();

    /**
     * Get exception message.
     */
    abstract public function getMessage(): string;
}
