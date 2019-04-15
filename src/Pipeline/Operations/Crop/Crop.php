<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Operations\Crop;


use CrpTecnologia\ImaginaryClient\Pipeline\Operations\OperationInterface;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Size;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\SizeableTrait;


class Crop implements OperationInterface
{
    use SizeableTrait;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    public function getName(): string
    {
        return 'crop';
    }

    public function getParameters(): array
    {
        return $this->sizeToArray();
    }
}
