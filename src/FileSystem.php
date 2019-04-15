<?php


namespace CrpTecnologia\ImaginaryClient;


use SplFileInfo;

class FileSystem implements FileSystemInterface
{

    public function dontExists(string $file): bool
    {
        return !$this->exists($file);
    }

    public function exists(string $file): bool
    {
        return file_exists($file);
    }

    public function extension(string $file): string
    {
        $info = new SplFileInfo($file);
        return $info->getExtension();
    }

    public function open(string $file)
    {
        return fopen($file, 'r');
    }
}
