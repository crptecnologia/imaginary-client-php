<?php


namespace CrpTecnologia\ImaginaryClient;


use InvalidArgumentException;

class SourceFile implements SourceInterface
{

    private const VALID_EXTENSIONS = [
        'png' => true,
        'jpeg' => true,
        'jpg' => true,
        'webp' => true
    ];
    /**
     * @var string
     */
    private $path;
    /**
     * @var FileSystemInterface
     */
    private $fileSystem;

    public function __construct(string $path, FileSystemInterface $fileSystem)
    {
        $this->path = $path;
        $this->fileSystem = $fileSystem;

        if (empty($path)) {
            throw  new InvalidArgumentException('source is required', 0);
        }

        if ($this->fileSystem->dontExists($path)) {
            throw  new InvalidArgumentException('file does not exist', 1);
        }

        if ($this->isNotValidExtension()) {
            throw  new InvalidArgumentException('invalid extension', 2);
        }
    }

    private function isNotValidExtension(): bool
    {
        return !$this->isValidExtension();
    }

    private function isValidExtension(): bool
    {
        $extension = $this->fileSystem->extension($this->path);

        $extension = strtolower($extension);

        return array_key_exists($extension, self::VALID_EXTENSIONS);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return 'file';
    }

    /**
     * @param FileSystemInterface $fileSystem
     */
    public function setFileSystem(FileSystemInterface $fileSystem): void
    {
        $this->fileSystem = $fileSystem;
    }
}
