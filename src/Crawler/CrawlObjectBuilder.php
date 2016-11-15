<?php
namespace Crawler;

use Crawler\Content\WebContentPage;

abstract class CrawlObjectBuilder{

    /**
     * @var CrawlObject
     */
    protected $buildObject;

    public function __construct()
    {

    }

    /**
     * @param string $url
     * @return CrawlObjectBuilder $this
     */
    public function setUrl($url){
        $this->buildObject->setUrl($url);
        return $this;
    }

    /**
     * @param WebContentPage $webContentPage
     * @return CrawlObjectBuilder $this
     */
    public function setWebContentPage($webContentPage){
        $this->buildObject->setWebContent($webContentPage);
        return $this;
    }

    /**
     * @return CrawlObject
     */
    public function build(){
        $this->validate();
        return $this->buildObject;
    }

    /**
     * @throws \Exception
     */
    public function validate(){
        if(empty($this->buildObject->getUrl())){
            throw new \Exception("Url not defined");
        }

        if(empty($this->buildObject->getWebContent())){
            throw new \Exception("WebContent not defined");
        }
    }
}