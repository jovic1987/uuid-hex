<?php

declare(strict_types=1);

namespace G4\UuidHex\Exception;

class InvalidUuidHexException extends \InvalidArgumentException
{
    public function __construct(string $value)
    {
        $message = sprintf('Argument "%s" is invalid. Argument must be a Uuid Hex string.', $value);
        parent::__construct($message, 400);
    }
}
