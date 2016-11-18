<?php
namespace Crawler\Content;

/**
 * https://dzone.com/articles/factories-builders-and-fluent-
 * Class WebContentBuilder
 * @package Crawler\Content
 */
/**
 * Class WebContentBuilder
 * @package Crawler\Content
 */
abstract class WebContentBuilder{
    /**
     * @var WebContent
     */
    protected $buildObject;

    /**
     * WebContentBuilder constructor.
     */
    public function __construct()
    {
        $this->buildObject->setCacheEnabled(true);
        $this->buildObject->setInterval(0);
        $this->buildObject->setUseragent("Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.coms/bot.html)");
        $this->buildObject->setCookieEnabled(false);
        $this->buildObject->setCookiePath("");
        $this->buildObject->setHardDirectoring(false);
        $this->buildObject->setVerifyPeer(true);
        $this->buildObject->setVerbose(false);
    }

    /**
     * @param string $url
     * @return WebContentBuilder $this
     */
    public function setUrl($url){
        $this->buildObject->setUrl($url);
        return $this;
    }

    /**
     * @param string $path
     * @return WebContentBuilder $this
     */
    public function setBasePath($path){
        $this->buildObject->setBasePath($path);
        return $this;
    }

    /**
     * @param bool $enabled
     * @return WebContentBuilder $this
     */
    public function setCacheEnabled($enabled){
        $this->buildObject->setCacheEnabled($enabled);
        return $this;
    }

    /**
     * @param int $interval
     * @return WebContentBuilder $this
     */
    public function setInterval($interval){
        $this->buildObject->setInterval($interval);
        return $this;
    }

    /**
     * @param string $useragent
     * @return WebContentBuilder $this
     */
    public function setUseragent($useragent){
        $this->buildObject->setUseragent($useragent);
        return $this;
    }

    /**
     * @param bool $enabled
     * @return WebContentBuilder $this
     */
    public function setCookieEnabled($enabled){
        $this->buildObject->setCookieEnabled($enabled);
        return $this;
    }

    /**
     * @param string $path
     * @return WebContentBuilder $this
     */
    public function setCookiePath($path){
        $this->buildObject->setCookiePath($path);
        return $this;
    }

    /**
     * @param bool $enabled
     * @return WebContentBuilder $this
     */
    public function setHardDirectoring($enabled){
        $this->buildObject->setHardDirectoring($enabled);
        return $this;
    }

    /**
     * @param bool $enabled
     * @return WebContentBuilder $this
     */
    public function setVerifyPeer($enabled){
        $this->buildObject->setVerifyPeer($enabled);
        return $this;
    }

    /**
     * @param bool $verbose
     * @return WebContentBuilder $this
     */
    public function setVerbose($verbose){
        $this->buildObject->setVerbose($verbose);
        return $this;
    }

    /**
     * @return WebContent
     */
    public function build(){
        $this->validate();
        return $this->buildObject;
    }

    /**
     * @return WebContentBuilder $this
     * @throws \Exception
     */
    public function validate(){
        if(empty($this->buildObject->getUrl())){
            throw new \Exception("Url not defined");
        }
        return $this;
    }

}