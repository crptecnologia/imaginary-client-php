<?php


namespace CrpTecnologia\ImaginaryClient;


interface SourceFactoryInterface
{
    public function make(string $source): SourceInterface;
}
