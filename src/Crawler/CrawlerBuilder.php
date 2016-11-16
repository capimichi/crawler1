<?php
namespace Crawler;

use Crawler\Single\Fields\Field;

/**
 * Class CrawlerBuilder
 * @package Crawler
 */
class CrawlerBuilder{

    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * CrawlerBuilder constructor.
     */
    public function __construct()
    {
        $this->crawler->setStartingUrls(array());
        $this->crawler->setItemsSelectors(array());
        $this->crawler->setNextpageSelectors(array());
        $this->crawler->setFields(array());
        $this->crawler->setVerbose(false);
    }

    /**
     * @param string $url
     * @return CrawlerBuilder $this
     */
    public function addStartingUrl($url){
        $urls = $this->crawler->getStartingUrls();
        $urls[] = $url;
        $this->crawler->setStartingUrls($urls);
        return $this;
    }

    /**
     * @param Selector $selector
     * @return CrawlerBuilder $this
     */
    public function addItemSelector($selector){
        $selectors = $this->crawler->getItemsSelectors();
        $selectors[] = $selector;
        $this->crawler->setStartingUrls($selectors);
        return $this;
    }

    /**
     * @param Selector $selector
     * @return CrawlerBuilder $this
     */
    public function addNextpageSelector($selector){
        $selectors = $this->crawler->getNextpageSelectors();
        $selectors[] = $selector;
        $this->crawler->setNextpageSelectors($selectors);
        return $this;
    }

    /**
     * @param Field $field
     * @return CrawlerBuilder $this
     */
    public function addField($field){
        $fields = $this->crawler->getFields();
        $fields[] = $field;
        $this->crawler->setFields($fields);
        return $this;
    }

    /**
     * @param bool $verbose
     * @return CrawlerBuilder $this
     */
    public function setVerbose($verbose){
        $this->crawler->setVerbose($verbose);
        return $this;
    }

    /**
     * @return CrawlerBuilder $this
     * @throws \Exception
     */
    public function validate(){
        if(count($this->crawler->getStartingUrls()) < 1){
            throw new \Exception("Urls not defined");
        }

        if(count($this->crawler->getItemsSelectors()) < 1){
            throw new \Exception("Items selectors not defined");
        }

        if(count($this->crawler->getFields()) < 1){
            throw new \Exception("Fields not defined");
        }
        return $this;
    }

    /**
     * @return Crawler
     */
    public function build(){
        $this->validate();
        return $this->crawler;
    }
}