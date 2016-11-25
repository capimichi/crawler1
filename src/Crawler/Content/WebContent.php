<?php
namespace Crawler\Content;



/**
 * Class WebContent
 * @package Crawler\Content\Web
 */
abstract class WebContent
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $useragent;

    /**
     * @var int
     */
    protected $interval;

    /**
     * @var bool
     */
    protected $cookieEnabled;

    /**
     * @var string
     */
    protected $cookiePath;

    /**
     * @var bool
     */
    protected $verifyPeer;

    /**
     * @var int
     */
    protected $connectionTimeout;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var bool
     */
    protected $hardDirectoring;

    /**
     * @var bool
     */
    protected $cacheEnabled;

    /**
     * @var bool
     */
    protected $verbose;

    public function __construct()
    {
        $this->setCacheEnabled(true);
        $this->setInterval(0);
        $this->setUseragent("Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.coms/bot.html)");
        $this->setCookieEnabled(false);
        $this->setCookiePath("");
        $this->setHardDirectoring(false);
        $this->setVerifyPeer(true);
        $this->setConnectionTimeout(0);
        $this->setTimeout(1000000);
        $this->setVerbose(false);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if(!isset($this->content)){
            if($this->isFileDownloaded() && $this->isCacheEnabled()){
                if($this->isVerbose()){
                    echo str_pad($this->getUrl(), 100) . "[cached]\n";
                }
                $this->setContent($this->fetchCachedContent($this->getFilePath()));
            } else {
                if($this->isVerbose()){
                    echo str_pad($this->getUrl(), 100) . "[downloading]\n";
                }
                $this->setContent($this->downloadContent());
                $this->saveContent();
            }
        }
        return $this->content;
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
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $useragent
     */
    public function setUseragent($useragent)
    {
        $this->useragent = $useragent;
    }

    /**
     * @param int $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @param boolean $cookieEnabled
     */
    public function setCookieEnabled($cookieEnabled)
    {
        $this->cookieEnabled = $cookieEnabled;
    }


    /**
     * @param string $cookiePath
     */
    public function setCookiePath($cookiePath)
    {
        $this->cookiePath = $cookiePath;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return md5($this->getUrl());
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        $path = $this->getBasePath();
        if ($this->isHardDirectoring()) {
            $path .= $this->getHardDirectory();
        }
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $path .= $this->getFileName();
        return $path;
    }

    /**
     * @param string $path
     * @return void
     */
    public function setBasePath($path)
    {
        $this->basePath = $path;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @return bool
     */
    public function isFileDownloaded()
    {
        $file = $this->getFilePath();
        if (file_exists($file)) {
            if (is_readable($file)) {
                if (filesize($file) > 0) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $hard
     * @return void
     */
    public function setHardDirectoring($hard)
    {
        $this->hardDirectoring = $hard;
    }

    /**
     * @return null|string
     */
    public function loadContent(){
        if($this->isFileDownloaded()){
            return file_get_contents($this-$this->getFilePath());
        } else {
            return null;
        }
    }

    /**
     * @return void
     */
    public function saveContent()
    {
        file_put_contents($this->getFilePath(), $this->getContent());
    }

    /**
     * @param boolean $cacheEnabled
     */
    public function setCacheEnabled($cacheEnabled)
    {
        $this->cacheEnabled = $cacheEnabled;
    }

    /**
     * @param boolean $verifyPeer
     */
    public function setVerifyPeer($verifyPeer)
    {
        $this->verifyPeer = $verifyPeer;
    }

    /**
     * @return int
     */
    public function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * @param int $connectionTimeout
     */
    public function setConnectionTimeout($connectionTimeout)
    {
        $this->connectionTimeout = $connectionTimeout;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @param boolean $verbose
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;
    }

    /**
     * @return string
     */
    protected function getUseragent()
    {
        return $this->useragent;
    }

    /**
     * @return boolean
     */
    protected function isCookieEnabled()
    {
        return $this->cookieEnabled;
    }

    /**
     * @return int
     */
    protected function getInterval()
    {
        return $this->interval;
    }

    /**
     * @return string
     */
    protected function getCookiePath()
    {
        return $this->cookiePath;
    }

    /**
     * @param string $path
     * @return string
     */
    protected function fetchCachedContent($path)
    {
        $content = file_get_contents($path);
        return $content;
    }


    /**
     * @return string|bool
     * @throws \Exception
     */
    protected function downloadContent()
    {
        $url = $this->getUrl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->isVerifyPeer());
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->getUseragent());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , $this->getConnectionTimeout());
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->getTimeout());
        if($this->isCookieEnabled()) {
            curl_setopt($ch, CURLOPT_COOKIE, true);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $this->getCookiePath());
            curl_setopt($ch, CURLOPT_COOKIEJAR, $this->getCookiePath());
        }
        usleep($this->getInterval());
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    /**
     * @param string $content
     */
    protected function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    protected function getHardDirectory()
    {
        return implode(DIRECTORY_SEPARATOR, str_split(md5($this->getUrl()), 2)) . DIRECTORY_SEPARATOR;
    }

    /**
     * @return bool
     */
    protected function isHardDirectoring()
    {
        return $this->hardDirectoring;
    }

    /**
     * @return boolean
     */
    protected function isCacheEnabled()
    {
        return $this->cacheEnabled;
    }

    /**
     * @return boolean
     */
    protected function isVerifyPeer()
    {
        return $this->verifyPeer;
    }

    /**
     * @return boolean
     */
    protected function isVerbose()
    {
        return $this->verbose;
    }
}