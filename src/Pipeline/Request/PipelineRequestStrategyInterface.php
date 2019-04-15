<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;


interface PipelineRequestStrategyInterface
{

    public function getMethod(): string;

    public function getUri(): string;

    public function getBody(): array;
}
