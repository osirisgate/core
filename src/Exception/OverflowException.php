<?php

declare(strict_types=1);

namespace Osirisgate\Core\Exception;

use Osirisgate\Core\Enum\StatusCode;

final class OverflowException extends Exception
{
    protected StatusCode $statusCode = StatusCode::UNPROCESSABLE_CONTENT;
}
