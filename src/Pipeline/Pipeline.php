<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline;

use CrpTecnologia\ImaginaryClient\DefaultConfiguration;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Crop\Crop;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\OperationInterface;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Resize\Resize;
use CrpTecnologia\ImaginaryClient\Pipeline\Operations\Size;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequest;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequestInterface;
use CrpTecnologia\ImaginaryClient\SourceInterface;
use Psr\Http\Message\StreamInterface;

class Pipeline
{
    /** @var OperationInterface[] */
    protected $operations = [];
    /**
     * @var SourceInterface
     */
    private $source;
    /**
     * @var PipelineRequest
     */
    private $request;
    /**
     * @var DefaultConfiguration
     */
    private $defaultConfiguration;


    public function __construct(
        DefaultConfiguration $defaultConfiguration,
        SourceInterface $source,
        PipelineRequestInterface $request
    ) {
        $this->request = $request;
        $this->source = $source;
        $this->defaultConfiguration = $defaultConfiguration;
    }

    public function resize(?int $width, ?int $height)
    {
        $this->addOperation(
            new Resize(new Size($width, $height))
        );

        return $this;
    }


    public function crop(?int $width, ?int $height)
    {
        $this->addOperation(
            new Crop(new Size($width, $height))
        );
        return $this;
    }

    public function finish(): ?StreamInterface
    {
        if (count($this->operations) === 0) {
            throw new NoOperationsToFinishException();
        }
        return $this->request->request($this->source, $this->operationsToArray());
    }

    private function operationsToArray()
    {
        return array_map(function (OperationInterface $operation) {
            return [
                'operation' => $operation->getName(),
                'params' => $operation->getParameters() + $this->defaultConfiguration->toArray(),
            ];
        }, $this->operations);
    }

    public function existsOperation(string $name): bool
    {
        return (bool)array_filter($this->operations, function (OperationInterface $operation) use ($name) {
            return $operation->getName() === $name;
        });
    }

    private function addOperation(OperationInterface $operation)
    {
        $this->operations[] = $operation;
    }
}
