<?php
namespace Crawler\Archive;

/**
 * Class CrawlArchiveBuilder
 * @package Crawler\Archive
 */
class CrawlArchiveBuilder{

    /**
     * @var CrawlArchive
     */
    protected $crawlArchive;

    /**
     * CrawlArchiveBuilder constructor.
     */
    public function __construct()
    {
        $this->crawlArchive = new CrawlArchive();
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url){
        $this->getCrawlArchive()->setUrl($url);
        return $this;
    }

    /**
     * @param $selector
     * @return $this
     */
    public function addItemSelector($selector){
        $selectors = $this->getCrawlArchive()->getItemsSelectors();
        if(!is_array($selectors)){
            $selectors = array($selectors);
        }
        $selectors[] = $selector;
        $this->getCrawlArchive()->setItemsSelectors($selectors);
        return $this;
    }

    /**
     * @param $selector
     * @return $this
     */
    public function addNextpageSelector($selector){
        $selectors = $this->getCrawlArchive()->getNextpageSelectors();
        if(!is_array($selectors)){
            $selectors = array($selectors);
        }
        $selectors[] = $selector;
        $this->getCrawlArchive()->getNextpageSelectors($selectors);
        return $this;
    }

    /**
     * @return CrawlArchive
     */
    protected function getCrawlArchive()
    {
        return $this->crawlArchive;
    }

    /**
     * @param CrawlArchive $crawlArchive
     */
    protected function setCrawlArchive($crawlArchive)
    {
        $this->crawlArchive = $crawlArchive;
    }


}