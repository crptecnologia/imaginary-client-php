<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;

use CrpTecnologia\ImaginaryClient\FileSystemInterface;
use CrpTecnologia\ImaginaryClient\SourceInterface;

class PipelineRequestStrategyFile implements PipelineRequestStrategyInterface
{
    /**
     * @var SourceInterface
     */
    private $source;
    /**
     * @var array
     */
    private $operations;
    /**
     * @var FileSystemInterface
     */
    private $fileSystem;

    public function __construct(
        SourceInterface $source,
        array $operations,
        FileSystemInterface $fileSystem
    ) {

        $this->source = $source;
        $this->operations = $operations;
        $this->fileSystem = $fileSystem;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        $operationsUrlSafe = $this->prepareOperations($this->operations);

        return PipelineRequest::END_POINT . "?operations=$operationsUrlSafe";
    }

    private function prepareOperations(array $operations): string
    {
        return urlencode(
            json_encode(
                $operations
            )
        );
    }

    public function getBody(): array
    {
        return [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => $this->fileSystem->open($this->source->getPath()),
                ]
            ]
        ];
    }


}
