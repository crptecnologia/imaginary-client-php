<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline\Operations;

interface OperationInterface
{
    public function getName(): string;

    public function getParameters(): array;
}
