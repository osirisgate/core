<?php

declare(strict_types=1);

namespace Osirisgate\Core\Exception;

use Osirisgate\Core\Enum\StatusCode;

final class ErrorException extends Exception
{
    protected StatusCode $statusCode = StatusCode::INTERNAL_SERVER_ERROR;
}
