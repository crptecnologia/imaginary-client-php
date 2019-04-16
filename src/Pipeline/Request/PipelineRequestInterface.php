<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;

use CrpTecnologia\ImaginaryClient\SourceInterface;
use Psr\Http\Message\StreamInterface;

interface PipelineRequestInterface
{
    /**
     * @param SourceInterface $source
     * @param array $operations
     * @return StreamInterface
     * @throws PipelineRequestException
     */
    public function request(SourceInterface $source, array $operations): StreamInterface;
}
