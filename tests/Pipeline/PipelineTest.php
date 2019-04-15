<?php


namespace Tests\Pipeline;


use CrpTecnologia\ImaginaryClient\DefaultConfiguration;
use CrpTecnologia\ImaginaryClient\Pipeline\NoOperationsToFinishException;
use CrpTecnologia\ImaginaryClient\Pipeline\Pipeline;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequestInterface;
use CrpTecnologia\ImaginaryClient\SourceInterface;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class PipelineTest extends TestCase
{

    /**
     * @var PipelineRequestInterface|MockInterface
     */
    private $pipelineRequestInterface;

    /**
     * @var SourceInterface
     */
    private $source;
    /**
     * @var Pipeline
     */
    private $pipeline;
    /**
     * @var DefaultConfiguration
     */
    private $defaultConfigration;

    public function setUp(): void
    {
        $this->pipelineRequestInterface = Mockery::mock(PipelineRequestInterface::class);
        $this->source = Mockery::mock(SourceInterface::class);
        $this->defaultConfigration = new DefaultConfiguration();
        $this->pipeline = new Pipeline($this->defaultConfigration, $this->source, $this->pipelineRequestInterface);
    }

    public function testFinishWithoutOperations()
    {
        $this->expectException(NoOperationsToFinishException::class);
        $this->pipeline->finish();
    }

    public function testIfFinishIsCallingPostCorrectly()
    {
        $this->pipelineRequestInterface->shouldReceive('request')
            ->with($this->source, [
                [
                    'operation' => 'crop',
                    'params' => ['width' => 500, 'height' => 200] + $this->defaultConfigration->toArray()
                ],
                [
                    'operation' => 'resize',
                    'params' => ['width' => 200, 'height' => 500] + $this->defaultConfigration->toArray(),
                ]
            ])
            ->andReturn(null);

        $this->pipeline->crop(500, 200)
            ->resize(200, 500)
            ->finish();

        $this->assertTrue(true);
    }

    public function testAddOperationCrop()
    {
        $this->pipeline->crop(500, 200);

        $this->assertTrue($this->pipeline->existsOperation('crop'));
    }

    public function testAddOperationResize()
    {
        $this->pipeline->resize(500, 200);
        $this->assertTrue($this->pipeline->existsOperation('resize'));
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
