<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline;


use CrpTecnologia\ImaginaryClient\DefaultConfiguration;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequestInterface;
use CrpTecnologia\ImaginaryClient\SourceFactoryInterface;

class PipelineFactory implements PipelineFactoryInterface
{

    /**
     * @var DefaultConfiguration
     */
    private $defaultConfiguration;
    /**
     * @var PipelineRequestInterface
     */
    private $pipelineRequest;
    /**
     * @var SourceFactoryInterface
     */
    private $sourceFactory;

    public function __construct(
        DefaultConfiguration $defaultConfiguration,
        PipelineRequestInterface $pipelineRequest,
        SourceFactoryInterface $sourceFactory
    ) {
        $this->defaultConfiguration = $defaultConfiguration;
        $this->pipelineRequest = $pipelineRequest;
        $this->sourceFactory = $sourceFactory;
    }

    public function make(string $source): Pipeline
    {
        return new Pipeline(
            $this->defaultConfiguration,
            $this->sourceFactory->make($source),
            $this->pipelineRequest
        );
    }

}
