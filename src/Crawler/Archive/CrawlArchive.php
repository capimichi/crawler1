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
    protected $itemsUrls;

    /**
     * @var array
     */
    protected $itemsInlineDom;

    /**
     * CrawlArchive constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getItemsUrls()
    {
        if(!isset($this->itemsUrls)){
            $xpathQueryBuilder = new XpathQueryBuilder();
            $query = $xpathQueryBuilder->addQueryBySelectors($this->getItemsSelectors())->getQuery();
            $elements = $this->getXpath()->query($query);
            $itemsUrls = array();
            for ($i = 0; $i < $elements->length; $i++) {
                $urlObj = $elements->item($i)->attributes->getNamedItem("href");
                if ($urlObj != null) {
                    $url = $this->parseUrl($urlObj->nodeValue);
                    $itemsUrls[] = $url;
                }
            }
            $this->setItemsUrls($itemsUrls);
        }
        return $this->itemsUrls;
    }

    /**
     * @return array
     */
    public function getItemsInlineDom(){
        if(!isset($this->itemsInlineDom)){
            $xpathQueryBuilder = new XpathQueryBuilder();
            $query = $xpathQueryBuilder->addQueryBySelectors($this->getItemsSelectors())->getQuery();
            $elements = $this->getXpath()->query($query);
            $items = array();
            for ($i = 0; $i < $elements->length; $i++) {
                $document = new \DOMDocument();
                $document->appendChild($document->importNode($elements->item($i), true));
                $items[] = $document;
            }
            $this->setItemsInlineDom($items);
        }
        return $this->itemsInlineDom;
    }

    /**
     * @param array $itemsInlineDom
     */
    public function setItemsInlineDom($itemsInlineDom)
    {
        $this->itemsInlineDom = $itemsInlineDom;
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
                $attributes = $element->attributes;
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
    public function getItemsSelectors()
    {
        return $this->itemsSelectors;
    }

    /**
     * @return mixed
     */
    public function getNextpageSelectors()
    {
        return $this->nextpageSelectors;
    }

    /**
     * @param array $itemsUrls
     */
    protected function setItemsUrls($itemsUrls)
    {
        $this->itemsUrls = $itemsUrls;
    }


}
