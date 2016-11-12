<?php
namespace Crawler;

use Crawler\Content\WebContentHandler;

abstract class CrawlObject implements ICrawlObject {


    /**
     * @var string
     */
    protected $url;

    /**
     * @var WebContentHandler
     */
    protected $webContentHandler;

    /**
     * CrawlObject constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->webContentHandler = new WebContentHandler($url);
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

}