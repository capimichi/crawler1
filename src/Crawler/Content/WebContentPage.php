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

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \DOMXPath
     */
    public function getDomXpath()
    {
        if(!isset($this->domXpath)){
            $this->setDomXpath(new \DOMXPath($this->getDomDocument()));
            $this->setContent(null);
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
    public function setDomDocument($domDocument)
    {
        $this->domDocument = $domDocument;
    }

    /**
     * @param \DOMXPath $domXpath
     */
    public function setDomXpath($domXpath)
    {
        $this->domXpath = $domXpath;
    }


}