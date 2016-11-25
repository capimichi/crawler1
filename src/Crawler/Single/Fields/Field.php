<?php
namespace Crawler\Single\Fields;
use Crawler\Single\CrawlSingle;

/**
 * Class Field
 * @package Crawler\Single\Fields
 */
abstract class Field {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $multiple;

    /**
     * @var array
     */
    protected $selectors;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var CrawlSingle
     */
    protected $crawlSingle;

    /**
     * @var array
     */
    protected $rewrites;

    public function __construct()
    {
        $this->setSelectors(array());
        $this->setMultiple(false);
        $this->setRewrites(array());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     * @return void
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return array
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * @param array $selectors
     * @return void
     */
    public function setSelectors($selectors)
    {
        $this->selectors = $selectors;
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
     * @return array
     */
    public function getExport()
    {

    }


    /**
     * @param CrawlSingle $crawlSingle
     */
    public function setCrawlSingle($crawlSingle)
    {
        $this->crawlSingle = $crawlSingle;
    }

    /**
     * @return CrawlSingle
     */
    public function getCrawlSingle()
    {
        return $this->crawlSingle;
    }

    /**
     * @return \DOMXPath
     */
    public function getXpath()
    {
        return $this->getCrawlSingle()->getXpath();
    }

    /**
     * @return array
     */
    public function getRewrites()
    {
        return $this->rewrites;
    }

    /**
     * @param array $rewrites
     */
    public function setRewrites($rewrites)
    {
        $this->rewrites = $rewrites;
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->getCrawlSingle()->getUrl();
    }

    /**
     * @param $url string
     * @return string
     */
    protected function parseUrl($url)
    {
        $originalParsed = parse_url($this->getUrl());
        $parsed = parse_url($url);
        $newUrl = "";
        if (!isset($parsed['host'])) {
            $newUrl .= $originalParsed['scheme'];
            $newUrl .= "://";
            $newUrl .= $originalParsed['host'];
            if ($url[0] !== "/") {
                $newUrl .= "/";
            }
        } else {
            if (!isset($parsed['scheme'])) {
                $newUrl = $originalParsed['scheme'] . ":";
            }
        }
        $newUrl .= $url;
        return $newUrl;
    }
}