<?php


namespace CrpTecnologia\ImaginaryClient;


class SourceFactory implements SourceFactoryInterface
{

    /**
     * @var FileSystemInterface
     */
    private $fileSystem;

    public function __construct(FileSystemInterface $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function make(string $source): SourceInterface
    {
        return new SourceFile($source, $this->fileSystem);
    }
}
