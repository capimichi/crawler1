<?php
namespace Crawler\Config;

/**
 * Class ConfigArchive
 * @package Crawler\Config
 */
class ConfigArchive extends ConfigObject {


    /**
     * @var array|null
     */
    protected $itemsSelectors;

    /**
     * @var array|null
     */
    protected $nextpageSelectors;

    /**
     * @return array|null
     */
    public function getItemsSelectors(){
        if(!isset($this->itemsSelectors)){
            $this->setItemsSelectors($this->getConfiguration()->archive->items->selectors);
        }
        return $this->itemsSelectors;
    }

    /**
     * @param array|null $itemsSelectors
     */
    public function setItemsSelectors($itemsSelectors)
    {
        $this->itemsSelectors = $itemsSelectors;
    }

    /**
     * @return array|null
     */
    public function getNextpageSelectors(){
        if(!isset($this->nextpageSelectors)){
            $this->getConfiguration()->archive->nextpage->selectors;
        }
        return $this->nextpageSelectors;
    }

    /**
     * @param array|null $nextpageSelectors
     */
    public function setNextpageSelectors($nextpageSelectors)
    {
        $this->nextpageSelectors = $nextpageSelectors;
    }


}