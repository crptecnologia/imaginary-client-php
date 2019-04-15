<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline\Operations\Resize;

use CrpTecnologia\ImaginaryClient\Pipeline\Operations\OperationInterface;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Size;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\SizeableTrait;


class Resize implements OperationInterface
{
    use SizeableTrait;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    public function getName(): string
    {
        return 'resize';
    }

    public function getParameters(): array
    {
        return $this->sizeToArray();
    }
}
