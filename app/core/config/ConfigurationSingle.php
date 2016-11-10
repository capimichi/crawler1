<?php

/**
 * Class ConfigurationSingle
 */
class ConfigurationSingle extends Configuration {

    /**
     * @return array|null
     */
    public function getFields(){
        return $this->getConfiguration()->single->fields;
    }

}