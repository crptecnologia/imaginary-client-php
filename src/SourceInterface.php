<?php


namespace CrpTecnologia\ImaginaryClient;


interface SourceInterface
{
    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getProtocol();
}
