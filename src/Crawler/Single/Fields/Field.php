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

    /**
     * Field constructor.
     * @param string $name
     * @param bool $multiple
     * @param array $selectors
     */
    public function __construct($name, $multiple, $selectors)
    {
        $this->setRewrites(array());
        $this->setName($name);
        $this->setMultiple($multiple);
        $this->setSelectors($selectors);
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
        // TODO: Implement getExport() method.
    }


    /**
     * @param CrawlSingle $crawlSingle
     */
    public function setCrawlSingle($crawlSingle)
    {
        $this->crawlSingle = $crawlSingle;
    }

    /**
     * @param $search
     * @param $replace
     */
    public function addRewrite($search, $replace){
        $rewrites = $this->getRewrites();
        $rewrites[] = new Rewrite($search, $replace);
        $this->setRewrites($rewrites);
    }

    /**
     * @return array
     */
    protected function getRewrites()
    {
        return $this->rewrites;
    }

    /**
     * @param array $rewrites
     */
    protected function setRewrites($rewrites)
    {
        $this->rewrites = $rewrites;
    }

    /**
     * @return \DOMXPath
     */
    protected function getXpath()
    {
        return $this->getCrawlSingle()->getXpath();
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->url;
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

    /**
     * @return CrawlSingle
     */
    protected function getCrawlSingle()
    {
        return $this->crawlSingle;
    }
}