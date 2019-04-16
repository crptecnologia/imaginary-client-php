<?php

namespace CrpTecnologia\ImaginaryClient\Pipeline\Request;

use CrpTecnologia\ImaginaryClient\SourceInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;

class PipelineRequest implements PipelineRequestInterface
{
    public const END_POINT = '/pipeline';
    /**
     * @var PipelineRequestStrategyFactoryInterface
     */
    private $strategyFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(
        ClientInterface $client,
        LoggerInterface $logger,
        PipelineRequestStrategyFactoryInterface $strategyFactory
    ) {
        $this->strategyFactory = $strategyFactory;
        $this->logger = $logger;
        $this->client = $client;
    }

    /**
     * @param SourceInterface $source
     * @param array $operations
     * @return StreamInterface
     * @throws PipelineRequestException
     */
    public function request(SourceInterface $source, array $operations): StreamInterface
    {
        $pipelineRequestStrategy = $this->strategyFactory->make($source, $operations);
        try {
            return $this->send($pipelineRequestStrategy);
        } catch (GuzzleException $e) {
            throw new PipelineRequestException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @param PipelineRequestStrategyInterface $strategy
     * @return StreamInterface
     * @throws GuzzleException
     */
    private function send(PipelineRequestStrategyInterface $strategy)
    {
        $response = $this->client->request(
            $strategy->getMethod(),
            $strategy->getUri(),
            $strategy->getBody()
        );

        return $response->getBody();
    }
}
