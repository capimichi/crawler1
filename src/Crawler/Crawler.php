<?php
namespace Crawler;

use Crawler\Archive\CrawlArchive;
use Crawler\Config\ConfigDownload;
use Crawler\Single\Fields\Field;


/**
 * Class Crawler
 * @package Crawler
 */
class Crawler extends ConfigurableDownloadObject
{


    /**
     * @var array
     */
    protected $startingUrls;

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
    protected $fields;


    /**
     * ICrawler constructor.
     * @param array|string $startingUrls
     * @param array|Selector $itemsSelectors
     * @param array|Selector $nextpageSelectors
     * @param array|Field $fields
     */
    public function __construct($startingUrls, $itemsSelectors, $nextpageSelectors, $fields)
    {
        if(!is_array($startingUrls)){
            $startingUrls = array($startingUrls);
        }
        $this->setStartingUrls($startingUrls);
        if(!is_array($itemsSelectors)){
            $itemsSelectors = array($itemsSelectors);
        }
        $this->setItemsSelectors($itemsSelectors);
        if(!is_array($nextpageSelectors)){
            $nextpageSelectors = array($nextpageSelectors);
        }
        $this->setNextpageSelectors($nextpageSelectors);
        if(!is_array($fields)){
            $fields = array($fields);
        }
        foreach($fields as $field){
            if(!is_array($field->getSelectors())){
                $field->setSelectors(array($field->getSelectors()));
            }
        }
        $this->setFields($fields);
    }

    /**
     * @return array
     */
    public function getArchives()
    {
        $archives = array();
        foreach ($this->getStartingUrls() as $startingUrl) {
            $archive = new CrawlArchive(
                $startingUrl,
                $this->getItemsSelectors(),
                $this->getNextpageSelectors(),
                $this->getFields(),
                $this
            );
            $archives[] = $archive;
            while( ($nextPageUrl = $archive->getNextpageUrl()) != null){
                $archive = new CrawlArchive(
                    $nextPageUrl,
                    $this->getItemsSelectors(),
                    $this->getNextpageSelectors(),
                    $this->getFields(),
                    $this
                );
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