<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline;

interface PipelineFactoryInterface
{
    public function make(string $source): Pipeline;
}
