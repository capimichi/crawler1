<?php
namespace Crawler\Single\Fields;

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
     * @var \DOMXPath
     */
    protected $xpath;

    /**
     * @var string
     */
    protected $url;


    /**
     * Field constructor.
     * @param string $name
     * @param bool $multiple
     * @param array $selectors
     */
    public function __construct($name, $multiple, $selectors)
    {
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
     * @param \DOMXPath $xpath
     * @return void
     */
    public function setXpath($xpath)
    {
        $this->xpath = $xpath;
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
     * @return \DOMXPath
     */
    protected function getXpath()
    {
        return $this->xpath;
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

}