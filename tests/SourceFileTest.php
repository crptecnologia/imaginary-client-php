<?php

namespace Tests;

use CrpTecnologia\ImaginaryClient\FileSystemInterface;
use CrpTecnologia\ImaginaryClient\SourceFactory;
use InvalidArgumentException;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class SourceFileTest extends TestCase
{
    /**
     * @var FileSystemInterface|MockInterface
     */
    private $fileSystemInterface;
    /**
     * @var SourceFactory
     */
    private $sourceFactory;

    public function setUp(): void
    {
        $this->fileSystemInterface = Mockery::mock(FileSystemInterface::class);
        $this->sourceFactory = new SourceFactory($this->fileSystemInterface);
    }

    public function testCreateWithEmptySource()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('source is required');
        $this->sourceFactory->make('');
    }

    public function testCreateWithSourceFileThatDoesNotExist()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('file does not exist');
        $file = 'file.png';

        $this->fileSystemInterface->shouldReceive('dontExists')
            ->with($file)
            ->andReturn(true);

        $this->sourceFactory->make($file);
    }

    public function testCreateWithNoImageFile()
    {
        $file = 'index.html';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('invalid extension');

        $this->fileSystemInterface->shouldReceive('dontExists')
            ->with($file)
            ->andReturn(false);

        $this->fileSystemInterface->shouldReceive('extension')
            ->with($file)
            ->andReturn('html');


        $this->sourceFactory->make($file);
    }
}
