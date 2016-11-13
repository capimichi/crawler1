<?php
namespace Crawler;

class Selector {

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * Selector constructor.
     * @param int $type
     * @param string $value
     */
    public function __construct($type, $value)
    {
        $this->setType($type);
        $this->setValue($value);
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}