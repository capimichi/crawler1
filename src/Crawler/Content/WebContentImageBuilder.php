<?php
namespace Crawler\Content;

/**
 * Class WebContentImageBuilder
 * @package Crawler\Content
 */
class WebContentImageBuilder extends WebContentBuilder
{

    /**
     * WebContentImageBuilder constructor.
     */
    public function __construct()
    {
        $this->buildObject = new WebContentImage();
        $this->buildObject->setBasePath(dirname(dirname(dirname(dirname(__FILE__)))) . "/var/images/");
        parent::__construct();
    }

    /**
     * @param string $url
     * @return WebContentImageBuilder
     */
    public function setUrl($url)
    {
        return parent::setUrl($url);
    }

    /**
     * @param string $path
     * @return WebContentImageBuilder
     */
    public function setBasePath($path)
    {
        return parent::setBasePath($path);
    }

    /**
     * @param bool $enabled
     * @return WebContentImageBuilder
     */
    public function setCacheEnabled($enabled)
    {
        return parent::setCacheEnabled($enabled);
    }

    /**
     * @param bool $enabled
     * @return WebContentImageBuilder
     */
    public function setCookieEnabled($enabled)
    {
        return parent::setCookieEnabled($enabled);
    }

    /**
     * @param string $path
     * @return WebContentImageBuilder
     */
    public function setCookiePath($path)
    {
        return parent::setCookiePath($path);
    }

    /**
     * @param bool $enabled
     * @return WebContentImageBuilder
     */
    public function setHardDirectoring($enabled)
    {
        return parent::setHardDirectoring($enabled);
    }

    /**
     * @param int $interval
     * @return WebContentImageBuilder
     */
    public function setInterval($interval)
    {
        return parent::setInterval($interval);
    }

    /**
     * @param string $useragent
     * @return WebContentImageBuilder
     */
    public function setUseragent($useragent)
    {
        return parent::setUseragent($useragent);
    }

    /**
     * @param bool $verbose
     * @return WebContentImageBuilder
     */
    public function setVerbose($verbose)
    {
        return parent::setVerbose($verbose);
    }

    /**
     * @param bool $enabled
     * @return WebContentImageBuilder
     */
    public function setVerifyPeer($enabled)
    {
        return parent::setVerifyPeer($enabled);
    }

    /**
     * @param int $timeout
     * @return WebContentImageBuilder
     */
    public function setTimeout($timeout)
    {
        return parent::setTimeout($timeout);
    }

    /**
     * @param int $timeout
     * @return WebContentImageBuilder
     */
    public function setConnectionTimeout($timeout)
    {
        return parent::setConnectionTimeout($timeout);
    }

    /**
     * @return WebContentImageBuilder
     */
    public function validate()
    {
        return parent::validate();
    }

    /**
     * @return WebContentImage
     */
    public function build()
    {
        return parent::build();
    }
}