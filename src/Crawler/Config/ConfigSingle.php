<?php
namespace Crawler\Config;

/**
 * Class ConfigSingle
 * @package Crawler\Config
 */
class ConfigSingle extends ConfigObject {

    /**
     * @return array|null
     */
    public function getFields(){
        return $this->getConfiguration()->single->fields;
    }
}