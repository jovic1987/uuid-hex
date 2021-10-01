<?php

declare(strict_types=1);

use G4\UuidHex\Exception\InvalidUuidHexException;
use G4\UuidHex\UuidHex;

class UuidHexTest extends \PHPUnit\Framework\TestCase
{
    public function testGenerate(): void
    {
        $uuidHex = UuidHex::generate();
        self::assertInstanceOf(UuidHex::class, $uuidHex);
    }

    public function testWithValidHex(): void
    {
        $uuidHex = new UuidHex('934f14b8b32c4e72a49fd48ce394b656');
        self::assertEquals('934f14b8b32c4e72a49fd48ce394b656', (string) $uuidHex);
    }

    public function testWithInvalidUuid(): void
    {
        $this->expectException(InvalidUuidHexException::class);
        new UuidHex('test123');
    }

    public function testGetUuid(): void
    {
        $uuidHex = new UuidHex('934f14b8b32c4e72a49fd48ce394b656');
        self::assertSame('934f14b8-b32c-4e72-a49f-d48ce394b656', $uuidHex->getUuid());
    }
}
