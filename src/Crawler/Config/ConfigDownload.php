<?php
namespace Crawler\Config;

/**
 * Class ConfigDownload
 * @package Crawler\Config
 */
class ConfigDownload extends ConfigObject {

    /**
     * @var int|null
     */
    protected $interval;

    /**
     * @var string|null
     */
    protected $userAgent;

    /**
     * @var bool|null
     */
    protected $cookieEnabled;

    /**
     * @var string|null
     */
    protected $cookieFile;

    /**
     * @var bool|null
     */
    protected $jsBlocked;

    /**
     * @return int|null
     */
    public function getInterval(){
        if(!isset($this->interval)){
            $this->setInterval(0);
        }
        return $this->interval;
    }

    /**
     * @param int|null $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return string|null
     */
    public function getUserAgent(){
        if(!isset($this->userAgent)){
            $this->setUserAgent($this->getConfiguration()->crawler->useragent);
        }
        return $this->userAgent;
    }

    /**
     * @param null|string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }


    /**
     * @return bool|null
     */
    public function isCookieEnabled(){
        if(!isset($this->cookieEnabled)){
            $this->setCookieEnabled($this->getConfiguration()->crawler->cookies->enabled);
        }
        return $this->cookieEnabled;
    }

    /**
     * @param bool|null $cookieEnabled
     */
    public function setCookieEnabled($cookieEnabled)
    {
        $this->cookieEnabled = $cookieEnabled;
    }

    /**
     * @return string|null
     */
    public function getCookieFile(){
        if(!isset($this->cookieFile)){
            $this->setCookieFile($this->getConfiguration()->crawler->cookies->file);
        }
        return $this->cookieFile;
    }

    /**
     * @param null|string $cookieFile
     */
    public function setCookieFile($cookieFile)
    {
        $this->cookieFile = $cookieFile;
    }

    /**
     * @return bool|null
     */
    public function isJsBlocked(){
        if(!isset($this->jsBlocked)){
            $this->setJsBlocked($this->getConfiguration()->crawler->stopjs);
        }
        return $this->jsBlocked;
    }

    /**
     * @param bool|null $jsBlocked
     */
    public function setJsBlocked($jsBlocked)
    {
        $this->jsBlocked = $jsBlocked;
    }
}