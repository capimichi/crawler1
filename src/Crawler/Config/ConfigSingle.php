<?php
namespace Crawler\Config;

/**
 * Class ConfigSingle
 * @package Crawler\Config
 */
class ConfigSingle extends ConfigObject {

    protected $fields;

    /**
     * @return array|null
     */
    public function getFields(){
        if(!isset($this->fields)){
            $this->setFields($this->getConfiguration()->single->fields);
        }
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}