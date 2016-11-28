<?php
namespace Crawler\Content;

/**
 * Class WebContentPageBuilder
 * @package Crawler\Content
 */
class WebContentPageBuilder extends WebContentBuilder
{

    /**
     * WebContentPageBuilder constructor.
     */
    public function __construct()
    {
        $this->buildObject = new WebContentPage();
        $this->buildObject->setBasePath(dirname(dirname(dirname(dirname(__FILE__)))) . "/var/cache/");
        parent::__construct();
    }

    /**
     * @param string $url
     * @return WebContentPageBuilder $this
     */
    public function setUrl($url)
    {
        return parent::setUrl($url);
    }

    /**
     * @param string $path
     * @return WebContentPageBuilder $this
     */
    public function setBasePath($path)
    {
        return parent::setBasePath($path);
    }

    /**
     * @param bool $enabled
     * @return WebContentPageBuilder $this
     */
    public function setCacheEnabled($enabled)
    {
        return parent::setCacheEnabled($enabled);
    }

    /**
     * @param int $interval
     * @return WebContentPageBuilder $this
     */
    public function setInterval($interval)
    {
        return parent::setInterval($interval);
    }

    /**
     * @param string $useragent
     * @return WebContentPageBuilder $this
     */
    public function setUseragent($useragent)
    {
        return parent::setUseragent($useragent);
    }

    /**
     * @param bool $enabled
     * @return WebContentPageBuilder $this
     */
    public function setCookieEnabled($enabled)
    {
        return parent::setCookieEnabled($enabled);
    }

    /**
     * @param string $path
     * @return WebContentPageBuilder $this
     */
    public function setCookiePath($path)
    {
        return parent::setCookiePath($path);
    }

    /**
     * @param bool $enabled
     * @return WebContentPageBuilder $this
     */
    public function setHardDirectoring($enabled)
    {
        return parent::setHardDirectoring($enabled);
    }

    /**
     * @param bool $enabled
     * @return WebContentPageBuilder $this
     */
    public function setVerifyPeer($enabled)
    {
        return parent::setVerifyPeer($enabled);
    }

    /**
     * @param bool $verbose
     * @return WebContentPageBuilder $this
     */
    public function setVerbose($verbose)
    {
        return parent::setVerbose($verbose);
    }

    /**
     * @param int $timeout
     * @return WebContentPageBuilder
     */
    public function setTimeout($timeout)
    {
        return parent::setTimeout($timeout);
    }

    /**
     * @param int $timeout
     * @return WebContentPageBuilder
     */
    public function setConnectionTimeout($timeout)
    {
        return parent::setConnectionTimeout($timeout);
    }

    /**
     * @param string|bool $proxyUrl
     * @return WebContentPageBuilder
     */
    public function setProxyUrl($proxyUrl)
    {
        return parent::setProxyUrl($proxyUrl);
    }

    /**
     * @param int $proxyType
     * @return WebContentPageBuilder
     */
    public function setProxyType($proxyType)
    {
        return parent::setProxyType($proxyType);
    }

    /**
     * @return WebContentPageBuilder $this
     * @throws \Exception
     */
    public function validate()
    {
        return parent::validate();
    }

    /**
     * @return WebContentPage
     */
    public function build()
    {
        return parent::build();
    }


}