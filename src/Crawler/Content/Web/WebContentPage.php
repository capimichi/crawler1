<?php
namespace Crawler\Content\Web;

use Crawler\Content\FileSystem\CacheSystemHandler;

class WebContentPage extends WebContent {

    /**
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * @var \DOMXPath
     */
    protected $domXpath;


    public function getContent(){
        if(!isset($this->content)){
            $fileSystemHandler = new CacheSystemHandler($this->getUrl());
            if($fileSystemHandler->isFileDownloaded()){
                $content = $this->fetchCachedContent($fileSystemHandler->getFilePath());
            } else {
                $content = $this->downloadContent();
                $fileSystemHandler->saveContent($content);
            }
            $this->setContent($content);
        }
        return $this->content;
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