<?php


namespace Tests\Pipeline\Operations;


use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Size;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
    public function testCreateWithNegativeWidth()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Width can not be negative');
        new Size(-10, 20);

    }

    public function testCreateWithNegativeHeight()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Height can not be negative');
        new Size(10, -1);

    }

    public function testCreateWithArgumentsNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required param: height or width');
        new Size(null, null);
    }

    public function testCreateWithHeightNull()
    {
        $size = new Size(10, null);

        $this->assertEquals(null, $size->getHeight());
        $this->assertEquals(10, $size->getWidth());
    }

    public function testCreateWithWidthNull()
    {
        $size = new Size(null, 10);

        $this->assertEquals(null, $size->getWidth());
        $this->assertEquals(10, $size->getHeight());
    }

    public function testCreateWithPositiveNumbers()
    {
        $size = new Size(10, 10);

        $this->assertEquals(10, $size->getWidth());
        $this->assertEquals(10, $size->getHeight());
    }
}
