<?php

/**
 * Class Crawler
 */
class Crawler{
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $content;
    /**
     * @var DOMDocument
     */
    protected $domDocument;
    /**
     * @var DOMXPath
     */
    protected $domXpath;
    /**
     * @var ConfigurationHandler
     */
    protected $configurationHandler;

    public function __construct( $url, $configurationHandler )
    {
        $this->setUrl($url);
        $this->setConfigurationHandler($configurationHandler);
    }

    /**
     * @param string $url
     * @return mixed
     */
    protected function downloadData($url){
        $interval = $this->getConfigurationHandler()->getConfigurationDownload()->getInterval();
        if($interval > 0){
            sleep($interval);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->getConfigurationHandler()->getConfigurationDownload()->getUserAgent());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if($this->getConfigurationHandler()->getConfigurationDownload()->isCookieEnabled()){
            $cookieFile = $this->getConfigurationHandler()->getConfigurationDownload()->getCookieFile();
            curl_setopt($ch, CURLOPT_COOKIE, true);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        }
        $content = curl_exec($ch);
        if($this->getConfigurationHandler()->getConfigurationDownload()->isJsBlocked()){
            $content = preg_replace("/<script.*?>.*?<\/script>/is", "", $content);
        }
        curl_close($ch);
        return $content;
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
     * @param $url string
     * @return string
     */
    public function parseUrl($url){
        $originalParsed = parse_url($this->getUrl());
        $parsed = parse_url($url);
        $newUrl = "";
        if(!isset($parsed['host'])){
            $newUrl .= $originalParsed['scheme'];
            $newUrl .= "://";
            $newUrl .= $originalParsed['host'];
            if($url[0] !== "/"){
                $newUrl .= "/";
            }
        }
        $newUrl .= $url;
        return $newUrl;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if(!isset($this->content)){
            if($this->getConfigurationHandler()->getConfigurationLocale()->isCacheEnabled()){
                if(!file_exists($this->getCachePath() . $this->cacheName())){
                    $content = $this->downloadData($this->getUrl());
                    file_put_contents($this->getCachePath() . $this->cacheName(), $content);
                } else {
                    $content = file_get_contents($this->getCachePath() . $this->cacheName());
                }
            } else {
                $content = $this->downloadData($this->getUrl());
            }
            if($this->getConfigurationHandler()->getConfigurationLocale()->isHtmlEnabled()){
                $htmlFile = $this->getHtmlPath() . $this->getHtmlName();
                if(!file_exists($htmlFile)){
                    file_put_contents($htmlFile, $content);
                }
            }
            $this->setContent($content);
        }
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return DOMDocument
     */
    public function getDomDocument()
    {
        if(!isset($this->domDocument)){
            $dom = new DOMDocument();
            @$dom->loadHTML($this->getContent());
            $this->setDomDocument($dom);
        }
        return $this->domDocument;
    }

    /**
     * @param mixed $domDocument
     */
    public function setDomDocument($domDocument)
    {
        $this->domDocument = $domDocument;
    }

    /**
     * @return DOMXPath
     */
    public function getDomXpath()
    {
        if(!isset($this->domXpath)){
            $this->setDomXpath(new DOMXPath($this->getDomDocument()));
        }
        return $this->domXpath;
    }

    /**
     * @param DOMXPath $domXpath
     */
    public function setDomXpath($domXpath)
    {
        $this->domXpath = $domXpath;
    }

    /**
     * @return string
     */
    public function getSubdirectory(){
        $subdir = implode(DIRECTORY_SEPARATOR, str_split(md5($this->getUrl()), 2)) . DIRECTORY_SEPARATOR;
        return $subdir;
    }

    /**
     * @return string
     */
    protected function getCachePath(){
        $path = $this->getConfigurationHandler()->getConfigurationLocale()->getCachePath();
        $path .= $this->getSubdirectory();
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        return $path;
    }

    /**
     * @return string
     */
    protected function cacheName(){
        return md5($this->getUrl());
    }

    /**
     * @return string
     */
    protected function getHtmlPath(){
        $path = $this->getConfigurationHandler()->getConfigurationLocale()->getHtmlPath();
        $path .= $this->getSubdirectory();
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        return $path;
    }

    /**
     * @return string
     */
    protected function getHtmlName(){
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->getUrl());
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        $file = $file . ".html";
        return $file;
    }

    /**
     * @return ConfigurationHandler
     */
    public function getConfigurationHandler()
    {
        if(!isset($this->configurationHandler)){
            $this->setConfigurationHandler(new ConfigurationHandler(dirname(dirname(dirname(__FILE__))) . "/config/config.json"));
        }
        return $this->configurationHandler;
    }

    /**
     * @param ConfigurationHandler $configurationHandler
     */
    public function setConfigurationHandler($configurationHandler)
    {
        $this->configurationHandler = $configurationHandler;
    }

    /**
     * Delete object and release memory used from the class
     */
    public function destroy(){
        unset($this->url);
        unset($this->content);
        unset($this->domDocument);
        unset($this->domXpath);
    }
}