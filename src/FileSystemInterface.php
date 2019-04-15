<?php


namespace CrpTecnologia\ImaginaryClient;


interface FileSystemInterface
{

    public function exists(string $file): bool;

    public function dontExists(string $file): bool;

    public function extension(string $file): string;

    public function open(string $file);
}
