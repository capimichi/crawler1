<?php
namespace Crawler;

use Crawler\Archive\CrawlArchive;
use Crawler\Archive\CrawlArchiveBuilder;
use Crawler\Config\ConfigDownload;
use Crawler\Content\WebContentPage;
use Crawler\Content\WebContentPageBuilder;
use Crawler\Single\CrawlSingleBuilder;
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
    protected $archives;

    /**
     * @var array
     */
    protected $items;

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
        if(!isset($this->archives)){
            $archives = array();
            foreach ($this->getStartingUrls() as $startingUrl) {
                $builder = new CrawlArchiveBuilder();
                $builder->setUrl($startingUrl);
                foreach($this->getItemsSelectors() as $itemsSelector){
                    $builder->addItemSelector($itemsSelector);
                }
                foreach($this->getNextpageSelectors() as $nextpageSelector){
                    $builder->addNextpageSelector($nextpageSelector);
                }
                $contentPageBuilder = new WebContentPageBuilder();
                $contentPageBuilder->setUrl($startingUrl);

                // TODO: Parametri al WebContentPage

                $builder->setWebContentPage($contentPageBuilder->build());
                $archive = $builder->build();
                $archives[] = $archive;
                while( ($nextPageUrl = $archive->getNextpageUrl()) != null){
                    $builder = new CrawlArchiveBuilder();
                    $builder->setUrl($nextPageUrl);
                    foreach($this->getItemsSelectors() as $itemsSelector){
                        $builder->addItemSelector($itemsSelector);
                    }
                    foreach($this->getNextpageSelectors() as $nextpageSelector){
                        $builder->addNextpageSelector($nextpageSelector);
                    }
                    $contentPageBuilder = new WebContentPageBuilder();
                    $contentPageBuilder->setUrl($nextPageUrl);

                    // TODO: Parametri al WebContentPage

                    $builder->setWebContentPage($contentPageBuilder->build());
                    $archive = $builder->build();
                    $archives[] = $archive;
                }
            }
            $this->setArchives($archives);
        }
        return $this->archives;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        if(!isset($this->items)){
            $items = array();
            foreach($this->getArchives() as $archive){
                $urls = $archive->getItemsUrls();
                foreach($urls as $url){
                    $builder = new CrawlSingleBuilder();
                    foreach($this->getFields() as $field){
                        $builder->addField($field);
                    }
                    $builder->setUrl($url);
                    $contentPageBuilder = new WebContentPageBuilder();
                    $contentPageBuilder->setUrl($url);

                    // TODO: Parametri al WebContentPage

                    $builder->setWebContentPage($contentPageBuilder->build());
                    $items[] = $builder->build();
                }
            }
            $this->setItems($items);
        }
        return $this->items;
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
     * @param array $items
     */
    protected function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @param array $archives
     */
    protected function setArchives($archives)
    {
        $this->archives = $archives;
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