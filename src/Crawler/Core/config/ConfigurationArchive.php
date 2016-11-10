<?php

/**
 * Class ConfigurationArchive
 */
class ConfigurationArchive extends Configuration {

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