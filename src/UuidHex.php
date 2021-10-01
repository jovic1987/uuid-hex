<?php

declare(strict_types=1);

namespace G4\UuidHex;

use G4\UuidHex\Exception\InvalidUuidHexException;
use Ramsey\Uuid\Codec\TimestampFirstCombCodec;
use Ramsey\Uuid\Generator\CombGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

class UuidHex
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $uuid;

    /**
     * UuidHex constructor.
     * @param string $value
     * @throws InvalidUuidHexException
     */
    final public function __construct(string $value)
    {
        if (!$this->isHex($value) || !Uuid::isValid($this->toUuid($value))) {
            throw new InvalidUuidHexException($value);
        }

        $this->uuid = $this->toUuid($value);
        $this->value = $value;
    }

    /**
     * @return UuidHex
     */
    public static function generate(): UuidHex
    {
        $factory = new UuidFactory();

        $factory->setCodec(new TimestampFirstCombCodec($factory->getUuidBuilder()));

        $factory->setRandomGenerator(new CombGenerator(
            $factory->getRandomGenerator(),
            $factory->getNumberConverter()
        ));

        return new static($factory->uuid4()->getHex());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param $value
     * @return string
     */
    private function toUuid(string $value): string
    {
        return (new UuidFactory())->fromBytes(hex2bin($value))->toString();
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isHex(string $string): bool
    {
        return @preg_match("/^[a-f0-9]{2,}$/i", $string) && !(strlen($string) & 1);
    }
}
