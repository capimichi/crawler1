<?php
namespace Crawler;

use Crawler\Content\WebContent;
use Crawler\Content\WebContentPage;

abstract class CrawlObject
{


    /**
     * @var string
     */
    protected $url;

    /**
     * @var WebContentPage
     */
    protected $webContent;

    /**
     * @var Crawler
     */
    protected $crawler;


    /**
     * CrawlObject constructor.
     * @param string $url
     * @param Crawler $crawler
     */
    public function __construct($url, $crawler)
    {
        $this->setUrl($url);
        $this->setCrawler($crawler);
        $this->setWebContent(new WebContentPage($url));
        $this->getWebContent()->setInterval($this->getInterval());
        $this->getWebContent()->setVerifyPeer($this->isVerifyPeer());
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if ($this->getWebContent()->isFileDownloaded()) {
            $content = $this->getWebContent()->loadContent();
        } else {
            if ($this->getInterval() > 0) {
                sleep($this->getInterval());
            }
            $content = $this->getWebContent()->getContent();
            $this->getWebContent()->saveContent();
        }
        return $content;
    }

    /**
     * @return \DOMDocument
     */
    public function getDomDocument()
    {
        return $this->getWebContent()->getDomDocument();
    }

    /**
     * @return \DOMXPath
     */
    public function getXpath()
    {
        return $this->getWebContent()->getDomXpath();
    }

    /**
     * @return Crawler
     */
    public function getCrawler()
    {
        return $this->crawler;
    }

    /**
     * @param Crawler $crawler
     */
    public function setCrawler($crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return interval
     */
    protected function getInterval()
    {
        return $this->getCrawler()->getInterval();
    }

    protected function isVerifyPeer()
    {
        return $this->getCrawler()->isVerifyPeer();
    }

    /**
     * @return WebContent
     */
    protected function getWebContent()
    {
        return $this->webContent;
    }

    /**
     * @param $url string
     * @return string
     */
    protected function parseUrl($url){
        $originalParsed = parse_url($this->getUrl());
        $parsed = parse_url($url);
        $newUrl = "";
        if(!isset($parsed['host'])){
            $newUrl .= $originalParsed['scheme'];
            $newUrl .= "://";
            $newUrl .= $originalParsed['host'];
            if($url[0] !== "/"){
                $newUrl .= "/";
            }
        } else{
            if(!isset($parsed['scheme'])){
                $newUrl = $originalParsed['scheme'] . ":";
            }
        }
        $newUrl .= $url;
        return $newUrl;
    }

    /**
     * @param WebContentPage $webContent
     */
    protected function setWebContent($webContent)
    {
        $this->webContent = $webContent;
    }

}