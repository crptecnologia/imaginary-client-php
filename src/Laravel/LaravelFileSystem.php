<?php


namespace CrpTecnologia\ImaginaryClient\Laravel;


use CrpTecnologia\ImaginaryClient\FileSystemInterface;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Filesystem\Filesystem;
use SplFileInfo;

class LaravelFileSystem implements FileSystemInterface
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function dontExists(string $file): bool
    {
        return !$this->exists($file);
    }

    public function exists(string $file): bool
    {
        return $this->filesystem->exists($file);
    }

    public function extension(string $file): string
    {
        $file = new SplFileInfo($file);
        return $file->getExtension();
    }

    /**
     * @param string $file
     * @return resource|null
     * @throws FileNotFoundException
     */
    public function open(string $file)
    {
        return $this->filesystem->readStream($file);
    }
}
