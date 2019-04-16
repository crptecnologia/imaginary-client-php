<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline;

use CrpTecnologia\ImaginaryClient\DefaultConfiguration;

interface PipelineFactoryInterface
{
    public function make(string $source): Pipeline;

    public function setDefaultConfiguration(DefaultConfiguration $defaultConfiguration): void;
}
