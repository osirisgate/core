<?php

declare(strict_types=1);

namespace Osirisgate\Core\Exception;

use Osirisgate\Core\Enum\StatusCode;

final class DomainException extends Exception
{
    protected StatusCode $statusCode = StatusCode::BAD_REQUEST;
}
