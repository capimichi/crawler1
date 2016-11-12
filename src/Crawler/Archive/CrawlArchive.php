<?php
namespace Crawler\Archive;

use Crawler\CrawlObject;
use Crawler\Utils\XpathQueryBuilder;

class CrawlArchive extends CrawlObject implements ICrawlArchive {


    protected $itemsSelectors;

    protected $nextpageSelectors;

    public function __construct($url, $itemsSelectors, $nextpageSelectors)
    {
        parent::__construct($url);
    }

    /**
     * @return array
     */
    public function getItems()
    {
        // TODO: Implement getItems() method.
    }

    /**
     * @return string|null
     */
    public function getNextpageUrl()
    {
        $xpathQueryBuilder = new XpathQueryBuilder();
        $xpathQueryBuilder = $xpathQueryBuilder->addQueryBySelectors($this->getNextpageSelectors());
    }


    /**
     * @return string
     */
    public function getHtml()
    {
        // TODO: Implement getHtml() method.
    }

    /**
     * @return \DOMXPath
     */
    public function getXpath()
    {
        // TODO: Implement getXpath() method.
    }

    /**
     * @param array $selectors
     * @return void
     */
    public function setItemsSelectors($selectors)
    {
        $this->itemsSelectors = $selectors;
    }

    /**
     * @param array $selectors
     * @return void
     */
    public function setNextpageSelectors($selectors)
    {
        $this->nextpageSelectors = $selectors;
    }


    /**
     * @return mixed
     */
    protected function getItemsSelectors()
    {
        return $this->itemsSelectors;
    }

    /**
     * @return mixed
     */
    protected function getNextpageSelectors()
    {
        return $this->nextpageSelectors;
    }

}
