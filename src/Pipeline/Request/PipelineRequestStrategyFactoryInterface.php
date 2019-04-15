<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;


use CrpTecnologia\ImaginaryClient\SourceInterface;

interface PipelineRequestStrategyFactoryInterface
{
    public function make(SourceInterface $source, array $operations): PipelineRequestStrategyInterface;
}
