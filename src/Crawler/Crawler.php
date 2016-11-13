<?php
namespace Crawler;

use Crawler\Archive\CrawlArchive;


/**
 * Class Crawler
 * @package Crawler
 */
class Crawler
{


    /**
     * @var
     */
    protected $startingUrls;

    /**
     * @var
     */
    protected $itemsSelectors;

    /**
     * @var
     */
    protected $nextpageSelectors;

    /**
     * @var
     */
    protected $fields;

    /**
     * ICrawler constructor.
     * @param array $startingUrls
     * @param array $itemsSelectors
     * @param array $nextpageSelectors
     * @param array $fields
     */
    public function __construct($startingUrls, $itemsSelectors, $nextpageSelectors, $fields)
    {
        $this->setStartingUrls($startingUrls);
        $this->setItemsSelectors($itemsSelectors);
        $this->setNextpageSelectors($nextpageSelectors);
        $this->setFields($fields);
    }

    /**
     * @return array
     */
    public function getArchives()
    {
        $archives = array();
        foreach ($this->getStartingUrls() as $startingUrl) {
            $archive = new CrawlArchive($startingUrl, $this->getItemsSelectors(), $this->getNextpageSelectors(), $this->getFields());
            $archives[] = $archive;
            while( ($nextPageUrl = $archive->getNextpageUrl()) != null){
                $archive = new CrawlArchive($nextPageUrl, $this->getItemsSelectors(), $this->getNextpageSelectors(), $this->getFields());
                $archives[] = $archive;
            }
        }
        return $archives;
    }

    /**
     * @return array
     */
    public function getStartingUrls()
    {
        return $this->startingUrls;
    }

    /**
     * @param array $urls
     * @return void
     */
    public function setStartingUrls($urls)
    {
        $this->startingUrls = $urls;
    }

    /**
     * @param mixed $itemsSelectors
     */
    protected function setItemsSelectors($itemsSelectors)
    {
        $this->itemsSelectors = $itemsSelectors;
    }

    /**
     * @param mixed $nextpageSelectors
     */
    protected function setNextpageSelectors($nextpageSelectors)
    {
        $this->nextpageSelectors = $nextpageSelectors;
    }

    /**
     * @param mixed $fields
     */
    protected function setFields($fields)
    {
        $this->fields = $fields;
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
     * @return mixed
     */
    protected function getFields()
    {
        return $this->fields;
    }

}