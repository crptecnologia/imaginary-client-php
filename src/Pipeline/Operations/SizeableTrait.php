<?php


namespace CrpTecnologia\ImaginaryClient\Pipeline\Operations;


trait SizeableTrait
{
    /**
     * @var Size
     */
    protected $size;

    public function sizeToArray(): array
    {
        $params = [];

        if ($this->size->hasWidth()) {
            $params['width'] = $this->size->getWidth();
        }

        if ($this->size->hasHeight()) {
            $params['height'] = $this->size->getHeight();
        }

        return $params;
    }
}
