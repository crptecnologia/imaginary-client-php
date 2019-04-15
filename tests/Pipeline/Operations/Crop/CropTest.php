<?php

namespace Tests\Pipeline\Operations\Crop;

use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Crop\Crop;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Size;
use PHPUnit\Framework\TestCase;

class CropTest extends TestCase
{


    public function testGetName()
    {
        $crop = new Crop(
            new Size(10, 10)
        );

        $this->assertEquals('crop', $crop->getName());
    }

    public function testGetParameters()
    {
        $crop = new Crop(new Size(10, 10));
        $expected = [
            'width' => 10,
            'height' => 10
        ];
        $this->assertEquals($expected, $crop->sizeToArray());
    }

    public function testWidthHeightNull()
    {
        $crop = new Crop(new Size(10, null));
        $expected = [
            'width' => 10,
        ];

        $this->assertEquals($expected, $crop->sizeToArray());
    }

    public function testWidthWidthNull()
    {
        $crop = new Crop(new Size(null, 10));

        $expected = [
            'height' => 10,
        ];

        $this->assertEquals($expected, $crop->sizeToArray());
    }
}
