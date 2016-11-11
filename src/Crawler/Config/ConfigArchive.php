<?php
namespace Crawler\Config;

/**
 * Class ConfigArchive
 * @package Crawler\Config
 */
class ConfigArchive extends ConfigObject {

    /**
     * @return array|null
     */
    public function getItemsSelectors(){
        return $this->getConfiguration()->archive->items->selectors;
    }

    /**
     * @return array|null
     */
    public function getNextpageSelectors(){
        return $this->getConfiguration()->archive->nextpage->selectors;
    }
}