<?php

/**
 * Class ConfigurationDownload
 */
class ConfigurationDownload extends Configuration {

    /**
     * @return int|null
     */
    public function getInterval(){
        return $this->getConfiguration()->crawler->interval;
    }

    /**
     * @return string|null
     */
    public function getUserAgent(){
        return $this->getConfiguration()->crawler->useragent;
    }

    /**
     * @return bool|null
     */
    public function isCookieEnabled(){
        return $this->getConfiguration()->crawler->cookies->enabled;
    }

    /**
     * @return string|null
     */
    public function getCookieFile(){
        return $this->getConfiguration()->crawler->cookies->file;
    }

    /**
     * @return bool|null
     */
    public function isJsBlocked(){
        return $this->getConfiguration()->crawler->stopjs;
    }
}