<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Operations;


use InvalidArgumentException;

class Size
{

    /**
     * @var int|null
     */
    private $width;
    /**
     * @var int|null
     */
    private $height;

    public function __construct(?int $width, ?int $height)
    {
        if ($width === null && $height === null) {
            throw new InvalidArgumentException('Missing required param: height or width');
        }

        if ($width !== null && $width < 0) {
            throw new InvalidArgumentException('Width can not be negative');
        }

        if ($height !== null && $height < 0) {
            throw new InvalidArgumentException('Height can not be negative');
        }


        $this->width = $width;
        $this->height = $height;
    }


    public function hasWidth()
    {
        return $this->width !== null;
    }

    public function hasHeight()
    {
        return $this->height !== null;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }
}
