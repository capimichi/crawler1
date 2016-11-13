<?php
namespace Crawler;

use Crawler\Content\Web\WebContent;
use Crawler\Content\Web\WebContentPage;

abstract class CrawlObject {


    /**
     * @var string
     */
    protected $url;

    /**
     * @var WebContentPage
     */
    protected $webContent;

    /**
     * CrawlObject constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->setUrl($url);
        $this->webContent = new WebContentPage($url);
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
        return $this->getWebContent()->getContent();
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
        }
        $newUrl .= $url;
        return $newUrl;
    }
}