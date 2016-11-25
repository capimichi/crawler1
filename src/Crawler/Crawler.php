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
     * @var bool
     */
    protected $verbose;

    /**
     * @var int|bool
     */
    protected $maxNextPage;

    /**
     * Crawler constructor.
     */
    public function __construct()
    {
        $this->setStartingUrls(array());
        $this->setItemsSelectors(array());
        $this->setNextpageSelectors(array());
        $this->setFields(array());
        $this->setVerbose(false);
        $this->setInterval(0);
        $this->setTimeout(10);
        $this->setConnectionTimeout(0);
        $this->setVerifyPeer(false);
        $this->setMaxNextPage(false);
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
                $contentPageBuilder
                    ->setUrl($startingUrl)
                    ->setVerbose($this->isVerbose())
                    ->setInterval($this->getInterval())
                    ->setTimeout($this->getTimeout())
                    ->setConnectionTimeout($this->getConnectionTimeout())
                    ->setVerifyPeer($this->isVerifyPeer());
                // TODO: Parametri al WebContentPage

                $builder->setWebContentPage($contentPageBuilder->build());
                $archive = $builder->build();
                $archives[] = $archive;
                $pageNumber = 0;
                $maxPage = $this->getMaxNextPage() === false ? 1 : intval($this->getMaxNextPage());
                while( (($nextPageUrl = $archive->getNextpageUrl()) != null) && ($pageNumber < $maxPage)){
                    if($this->getMaxNextPage() !== false){
                        $pageNumber++;
                    }
                    $builder = new CrawlArchiveBuilder();
                    $builder->setUrl($nextPageUrl);
                    foreach($this->getItemsSelectors() as $itemsSelector){
                        $builder->addItemSelector($itemsSelector);
                    }
                    foreach($this->getNextpageSelectors() as $nextpageSelector){
                        $builder->addNextpageSelector($nextpageSelector);
                    }
                    $contentPageBuilder = new WebContentPageBuilder();
                    $contentPageBuilder
                        ->setUrl($nextPageUrl)
                        ->setVerbose($this->isVerbose())
                        ->setInterval($this->getInterval())
                        ->setTimeout($this->getTimeout())
                        ->setConnectionTimeout($this->getConnectionTimeout())
                        ->setVerifyPeer($this->isVerifyPeer());

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
                    $contentPageBuilder->setVerbose($this->isVerbose());
                    $contentPageBuilder->setInterval($this->getInterval());
                    $contentPageBuilder->setTimeout($this->getTimeout());
                    $contentPageBuilder->setConnectionTimeout($this->getConnectionTimeout());

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
     * @return boolean
     */
    public function isVerbose()
    {
        return $this->verbose;
    }

    /**
     * @param boolean $verbose
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;
    }

    /**
     * @param mixed $itemsSelectors
     */
    public function setItemsSelectors($itemsSelectors)
    {
        $this->itemsSelectors = $itemsSelectors;
    }

    /**
     * @param mixed $nextpageSelectors
     */
    public function setNextpageSelectors($nextpageSelectors)
    {
        $this->nextpageSelectors = $nextpageSelectors;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
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
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return bool|int
     */
    public function getMaxNextPage()
    {
        return $this->maxNextPage;
    }

    /**
     * @param bool|int $maxNextPage
     */
    public function setMaxNextPage($maxNextPage)
    {
        $this->maxNextPage = $maxNextPage;
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
}