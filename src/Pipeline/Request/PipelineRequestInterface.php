<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;

use CrpTecnologia\ImaginaryClient\SourceInterface;
use Psr\Http\Message\StreamInterface;

interface PipelineRequestInterface
{
    public function request(SourceInterface $source, array $operations): ?StreamInterface;
}
