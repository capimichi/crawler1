<?php
namespace Crawler;

/**
 * Class ConfigurableDownloadObject
 * @package Crawler
 */
abstract class ConfigurableDownloadObject
{
    /**
     * @var int
     */
    protected $interval;

    /**
     * @var string
     */
    protected $useragent;

    /**
     * @var bool
     */
    protected $verifyPeer;

    /**
     * @var int
     */
    protected $timeout;
    /**
     * @var int
     */
    protected $connectionTimeout;

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
    protected $jsBlocked;

    /**
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param int $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return string
     */
    public function getUseragent()
    {
        return $this->useragent;
    }

    /**
     * @param string $useragent
     */
    public function setUseragent($useragent)
    {
        $this->useragent = $useragent;
    }

    /**
     * @return boolean
     */
    public function isVerifyPeer()
    {
        return $this->verifyPeer;
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
     * @return boolean
     */
    public function isCookieEnabled()
    {
        return $this->cookieEnabled;
    }

    /**
     * @param boolean $cookieEnabled
     */
    public function setCookieEnabled($cookieEnabled)
    {
        $this->cookieEnabled = $cookieEnabled;
    }

    /**
     * @return string
     */
    public function getCookiePath()
    {
        return $this->cookiePath;
    }

    /**
     * @param string $cookiePath
     */
    public function setCookiePath($cookiePath)
    {
        $this->cookiePath = $cookiePath;
    }

    /**
     * @return boolean
     */
    public function isJsBlocked()
    {
        return $this->jsBlocked;
    }

    /**
     * @param boolean $jsBlocked
     */
    public function setJsBlocked($jsBlocked)
    {
        $this->jsBlocked = $jsBlocked;
    }
}