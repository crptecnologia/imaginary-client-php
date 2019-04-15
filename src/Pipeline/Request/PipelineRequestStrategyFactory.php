<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;

use CrpTecnologia\ImaginaryClient\FileSystemInterface;
use CrpTecnologia\ImaginaryClient\SourceInterface;

class PipelineRequestStrategyFactory implements PipelineRequestStrategyFactoryInterface
{
    /**
     * @var FileSystemInterface
     */
    private $fileSystem;

    public function __construct(FileSystemInterface $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function make(SourceInterface $source, array $operations): PipelineRequestStrategyInterface
    {
        switch ($source->getProtocol()) {
            case 'file':
                return new PipelineRequestStrategyFile($source, $operations, $this->fileSystem);
                break;
            default:
                return new PipelineRequestStrategyFile($source, $operations, $this->fileSystem);
        }
    }
}
