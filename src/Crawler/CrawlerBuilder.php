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
        $this->crawler = new Crawler();
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
        $this->crawler->setItemsSelectors($selectors);
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
     * @return CrawlArchiveBuilder $this
     */
    public function addArchiveField($field)
    {
        $fields = $this->crawler->getArchiveFields();
        $fields[] = $field;
        $this->crawler->setArchiveFields($fields);
        return $this;
    }

    /**
     * @param Field $field
     * @return CrawlArchiveBuilder $this
     */
    public function addSingleField($field)
    {
        $fields = $this->crawler->getSingleFields();
        $fields[] = $field;
        $this->crawler->setSingleFields($fields);
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
     * @param int $interval
     * @return CrawlerBuilder $this
     */
    public function setInterval($interval){
        $this->crawler->setInterval($interval);
        return $this;
    }

    /**
     * @param int|bool $maxNextPage
     * @return CrawlerBuilder $this
     */
    public function setMaxNextPage($maxNextPage)
    {
        $this->crawler->setMaxNextPage($maxNextPage);
        return $this;
    }

    /**
     * @param int $timeout
     * @return CrawlerBuilder $this
     */
    public function setTimeout($timeout){
        $this->crawler->setTimeout($timeout);
        return $this;
    }

    /**
     * @param int $timeout
     * @return CrawlerBuilder $this
     */
    public function setConnectionTimeout($timeout){
        $this->crawler->setConnectionTimeout($timeout);
        return $this;
    }

    /**
     * @param string $useragent
     * @return CrawlerBuilder $this
     */
    public function setUseragent($useragent){
        $this->crawler->setUseragent($useragent);
        return $this;
    }

    /**
     * @param bool $verifyPeer
     * @return CrawlerBuilder $this
     */
    public function setVerifyPeer($verifyPeer){
        $this->crawler->setVerifyPeer($verifyPeer);
        return $this;
    }

    /**
     * @param string $proxyUrl
     * @return CrawlerBuilder $this
     */
    public function setProxyUrl($proxyUrl)
    {
        $this->crawler->setProxyUrl($proxyUrl);
        return $this;
    }

    /**
     * @param int $proxyType
     * @return CrawlerBuilder $this
     */
    public function setProxyType($proxyType)
    {
        $this->crawler->setProxyType($proxyType);
        return $this;
    }

    /**
     * @return CrawlerBuilder $this
     * @throws \Exception
     */
    public function validate(){
        if(count($this->crawler->getStartingUrls()) < 1){
            throw new \Exception("Starting urls not added in crawler builder");
        }

        if(count($this->crawler->getItemsSelectors()) < 1){
            throw new \Exception("Items selectors not added in crawler builder");
        }

        if(count($this->crawler->getFields()) < 1){
            throw new \Exception("Fields selectors not added in crawler builder");
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