<?php
namespace Crawler;

use Crawler\Content\WebContent;
use Crawler\Content\WebContentPage;

abstract class CrawlObject extends ConfigurableDownloadObject
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
     * CrawlObject constructor.
     */
    private function __construct()
    {

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
     * @param WebContentPage $webContent
     */
    public function setWebContent($webContent)
    {
        $this->webContent = $webContent;
    }


    /**
     * @return WebContent
     */
    public function getWebContent()
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
}