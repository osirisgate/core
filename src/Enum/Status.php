<?php

declare(strict_types=1);

namespace Osirisgate\Core\Enum;

enum Status: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';

    public function getValue(): string
    {
        return $this->value;
    }
}
