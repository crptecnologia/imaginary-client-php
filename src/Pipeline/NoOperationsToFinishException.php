<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline;


use LogicException;
use Throwable;

class NoOperationsToFinishException extends LogicException
{
    public function __construct($message = "no operations to finish", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
