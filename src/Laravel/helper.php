<?php


use CrpTecnologia\ImaginaryClient\Imaginary;
use CrpTecnologia\ImaginaryClient\Pipeline\Pipeline;

if (!function_exists('imaginary')) {
    function imaginary(string $source): Pipeline
    {
        return app(Imaginary::class)->from($source);
    }
}
