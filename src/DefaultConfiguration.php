<?php


namespace CrpTecnologia\ImaginaryClient;


class DefaultConfiguration
{
    /**
     * @var bool
     */
    private $stripMeta;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $extend;

    public function __construct(bool $stripMeta = true, $type = 'png', $extend = 'black')
    {
        $this->stripMeta = $stripMeta;
        $this->type = $type;
        $this->extend = $extend;
    }

    public function toArray()
    {
        return [
            'stripmeta' => $this->stripMeta,
            'type' => $this->type,
            'extend' => $this->extend
        ];
    }
}
