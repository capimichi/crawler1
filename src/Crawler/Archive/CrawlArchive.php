<?php
namespace Crawler\Archive;

use Crawler\CrawlObject;
use Crawler\Utils\XpathQueryBuilder;
use Crawler\Single\CrawlSingle;
use Crawler\Crawler;

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
    protected $items;

    /**
     * CrawlArchive constructor.
     * @param string $url
     * @param array $itemsSelectors
     * @param array $nextpageSelectors
     * @param array $fields
     * @param Crawler $crawler
     */
    public function __construct($url, $itemsSelectors, $nextpageSelectors, $fields, $crawler)
    {
        $this->setItemsSelectors($itemsSelectors);
        $this->setNextpageSelectors($nextpageSelectors);
        parent::__construct($url, $crawler);
        $this->setItems($this->findItems($fields));
    }


    protected function findItems($fields)
    {
        $xpathQueryBuilder = new XpathQueryBuilder();
        $query = $xpathQueryBuilder->addQueryBySelectors($this->getItemsSelectors())->getQuery();
        $elements = $this->getXpath()->query($query);
        $items = array();
        for ($i = 0; $i < $elements->length; $i++) {
            $urlObj = $elements->item($i)->attributes->getNamedItem("href");
            if ($urlObj != null) {
                $url = $this->parseUrl($urlObj->nodeValue);
                $item = new CrawlSingle(
                    $url,
                    $fields,
                    $this
                );
                $item->setInterval($this->getInterval());
                $items[] = $item;
            }
        }
        return $items;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
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
            $element = null;
            for ($i = 0; $i < $elements->length; $i++) {
                $element = $elements->item($i);
            }
            if ($element != null) {
                $attributes = $elements->attributes;
                if ($attributes != null) {
                    $urlObj = $attributes->getNamedItem("href");
                    if ($urlObj != null) {
                        $url = $this->parseUrl($urlObj->nodeValue);
                    }
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

    /**
     * @param array $items
     */
    protected function setItems($items)
    {
        $this->items = $items;
    }


}
