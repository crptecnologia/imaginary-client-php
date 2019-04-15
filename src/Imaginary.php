<?php

namespace CrpTecnologia\ImaginaryClient;

use CrpTecnologia\ImaginaryClient\Pipeline\Pipeline;
use CrpTecnologia\ImaginaryClient\Pipeline\PipelineFactoryInterface;

class Imaginary
{
    private $pipelineFactory;

    public function __construct(
        PipelineFactoryInterface $pipelineFactory
    ) {

        $this->pipelineFactory = $pipelineFactory;
    }

    public function from(string $source): Pipeline
    {
        return $this->pipelineFactory->make($source);
    }
}
