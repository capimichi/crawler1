<?php
namespace Crawler\Content;

class WebContentPage extends WebContent {

    /**
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * @var \DOMXPath
     */
    protected $domXpath;


    /**
     * WebContentPage constructor.
     * @param string $url
     */
    public function __construct($url, $basePath = null)
    {
        if($basePath == null){
            $basePath = dirname(dirname(dirname(dirname(__FILE__)))) . "/var/cache/";
        }
        parent::__construct($url, $basePath);
    }

    /**
     * @return \DOMXPath
     */
    public function getDomXpath()
    {
        if(!isset($this->domXpath)){
            $this->setDomXpath(new \DOMXPath($this->getDomDocument()));
        }
        return $this->domXpath;
    }

    /**
     * @return \DOMDocument
     */
    public function getDomDocument()
    {
        if(!isset($this->domDocument)){
            $dom = new \DOMDocument();
            @$dom->loadHTML($this->getContent());
            $this->setDomDocument($dom);
        }
        return $this->domDocument;
    }

    /**
     * @param \DOMDocument $domDocument
     */
    protected function setDomDocument($domDocument)
    {
        $this->domDocument = $domDocument;
    }

    /**
     * @param \DOMXPath $domXpath
     */
    protected function setDomXpath($domXpath)
    {
        $this->domXpath = $domXpath;
    }


}