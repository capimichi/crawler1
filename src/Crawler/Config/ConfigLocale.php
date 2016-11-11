<?php
namespace Crawler\Config;

/**
 * Class ConfigLocale
 * @package Crawler\Config
 */
class ConfigLocale extends ConfigObject {

    /**
     * @return bool|null
     */
    public function isCacheEnabled(){
        return $this->getConfiguration()->locale->cache->enabled;
    }

    /**
     * @return string|null
     */
    public function getCachePath(){
        return $this->getConfiguration()->locale->cache->path;
    }

    /**
     * @return bool|null
     */
    public function isHtmlEnabled(){
        return $this->getConfiguration()->locale->html->enabled;
    }

    /**
     * @return string|null
     */
    public function getHtmlPath(){
        return $this->getConfiguration()->locale->html->path;
    }

    /**
     * @return bool|null
     */
    public function isImagesEnabled(){
        return $this->getConfiguration()->locale->images->enabled;
    }

    /**
     * @return string|null
     */
    public function getImagesPath(){
        return $this->getConfiguration()->locale->images->path;
    }
}