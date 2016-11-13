<?php
namespace Crawler\Archive;

use Crawler\CrawlObject;
use Crawler\Utils\XpathQueryBuilder;
use Crawler\Single\CrawlSingle;

/**
 * Class CrawlArchive
 * @package Crawler\Archive
 */
class CrawlArchive extends CrawlObject
{


    /**
     * @var array
     */
    protected $itemsSelectors;

    /**
     * @var array
     */
    protected $nextpageSelectors;

    /**
     * @var array
     */
    protected $singleFields;

    /**
     * CrawlArchive constructor.
     * @param string $url
     * @param array $itemsSelectors
     * @param array $nextpageSelectors
     * @param array $fields
     */
    public function __construct($url, $itemsSelectors, $nextpageSelectors, $fields)
    {
        $this->setItemsSelectors($itemsSelectors);
        $this->setNextpageSelectors($nextpageSelectors);
        $this->singleFields = $fields;
        parent::__construct($url);
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $xpathQueryBuilder = new XpathQueryBuilder();
        $query = $xpathQueryBuilder->addQueryBySelectors($this->getItemsSelectors())->getQuery();
        $elements = $this->getXpath()->query($query);
        $items = array();
        for ($i = 0; $i < $elements->length; $i++) {
            $urlObj = $elements->item($i)->attributes->getNamedItem("href");
            if ($urlObj != null) {
                $url = $this->parseUrl($urlObj->nodeValue);
                $items[] = new CrawlSingle($url, $this->singleFields);
            }
        }
        return $items;
    }

    /**
     * @return string|null
     */
    public function getNextpageUrl()
    {
        $xpathQueryBuilder = new XpathQueryBuilder();
        $query = $xpathQueryBuilder->addQueryBySelectors($this->getNextpageSelectors())->getQuery();
        $xpath = $this->getXpath();
        $url = null;
        $elements = $xpath->query($query);
        if ($elements->length > 0) {
            $elements = $elements->item(0);
            $attributes = $elements->attributes;
            if ($attributes != null) {
                $urlObj = $attributes->getNamedItem("href");
//        $urlObj = $elements->item(0)->attributes->getNamedItem("href");
                if ($urlObj != null) {
                    $url = $this->parseUrl($urlObj->nodeValue);
                }
            }
        }
        return $url;
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
