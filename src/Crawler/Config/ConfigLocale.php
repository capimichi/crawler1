<?php
namespace Crawler\Config;

/**
 * Class ConfigLocale
 * @package Crawler\Config
 */
class ConfigLocale extends ConfigObject {

    protected $cacheEnabled;

    protected $cachePath;

    protected $htmlEnabled;

    protected $htmlPath;

    protected $imagesDownloadEnabled;

    protected $imagesDownloadPath;

    /**
     * @return bool|null
     */
    public function isCacheEnabled(){
        if(!isset($this->cacheEnabled)){
            $this->setCacheEnabled($this->getConfiguration()->locale->cache->enabled);
        }
        return $this->cacheEnabled;
    }

    /**
     * @param mixed $cacheEnabled
     */
    public function setCacheEnabled($cacheEnabled)
    {
        $this->cacheEnabled = $cacheEnabled;
    }

    /**
     * @return string|null
     */
    public function getCachePath(){
        if(!isset($this->cachePath)){
            $this->setCachePath($this->getConfiguration()->locale->cache->path);
        }
        return $this->cachePath;
    }

    /**
     * @param mixed $cachePath
     */
    public function setCachePath($cachePath)
    {
        $this->cachePath = $cachePath;
    }

    /**
     * @return bool|null
     */
    public function isHtmlEnabled(){
        if(!isset($this->htmlEnabled)){
            $this->setHtmlEnabled($this->getConfiguration()->locale->html->enabled);
        }
        return $this->htmlEnabled;
    }

    /**
     * @param mixed $htmlEnabled
     */
    public function setHtmlEnabled($htmlEnabled)
    {
        $this->htmlEnabled = $htmlEnabled;
    }

    /**
     * @return string|null
     */
    public function getHtmlPath(){
        if(!isset($this->htmlPath)){
            $this->setHtmlPath($this->getConfiguration()->locale->html->path);
        }
        return $this->htmlPath;
    }

    /**
     * @param mixed $htmlPath
     */
    public function setHtmlPath($htmlPath)
    {
        $this->htmlPath = $htmlPath;
    }

    /**
     * @return bool|null
     */
    public function isImagesDownloadEnabled(){
        if(!isset($this->imagesDownloadEnabled)){
            $this->setImagesDownloadEnabled($this->getConfiguration()->locale->images->enabled);
        }
        return $this->imagesDownloadEnabled;
    }

    /**
     * @param mixed $imagesDownloadEnabled
     */
    public function setImagesDownloadEnabled($imagesDownloadEnabled)
    {
        $this->imagesDownloadEnabled = $imagesDownloadEnabled;
    }

    /**
     * @return string|null
     */
    public function getImagesDownloadPath(){
        if(!isset($this->imagesDownloadPath)){
            $this->setImagesDownloadPath($this->getConfiguration()->locale->images->path);
        }
        return $this->imagesDownloadPath;
    }

    /**
     * @param mixed $imagesDownloadPath
     */
    public function setImagesDownloadPath($imagesDownloadPath)
    {
        $this->imagesDownloadPath = $imagesDownloadPath;
    }

}