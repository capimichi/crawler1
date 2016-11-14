<?php
namespace Crawler;

use Crawler\Archive\CrawlArchive;
use Crawler\Config\ConfigDownload;
use Crawler\Single\Fields\Field;


/**
 * Class Crawler
 * @package Crawler
 */
class Crawler
{


    /**
     * @var array
     */
    protected $startingUrls;

    /**
     * @var array
     */
    protected $itemsSelectors;

    /**
     * @var array
     */
    protected $nextpageSelectors;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var ConfigDownload
     */
    protected $configDownload;

    /**
     * ICrawler constructor.
     * @param array|string $startingUrls
     * @param array|Selector $itemsSelectors
     * @param array|Selector $nextpageSelectors
     * @param array|Field $fields
     */
    public function __construct($startingUrls, $itemsSelectors, $nextpageSelectors, $fields)
    {
        if(!is_array($startingUrls)){
            $startingUrls = array($startingUrls);
        }
        $this->setStartingUrls($startingUrls);
        if(!is_array($itemsSelectors)){
            $itemsSelectors = array($itemsSelectors);
        }
        $this->setItemsSelectors($itemsSelectors);
        if(!is_array($nextpageSelectors)){
            $nextpageSelectors = array($nextpageSelectors);
        }
        $this->setNextpageSelectors($nextpageSelectors);
        if(!is_array($fields)){
            $fields = array($fields);
        }
        $this->setFields($fields);
    }

    /**
     * @return array
     */
    public function getArchives()
    {
        $archives = array();
        foreach ($this->getStartingUrls() as $startingUrl) {
            $archive = new CrawlArchive(
                $startingUrl,
                $this->getItemsSelectors(),
                $this->getNextpageSelectors(),
                $this->getFields(),
                $this
            );
            $archives[] = $archive;
            while( ($nextPageUrl = $archive->getNextpageUrl()) != null){
                $archive = new CrawlArchive(
                    $nextPageUrl,
                    $this->getItemsSelectors(),
                    $this->getNextpageSelectors(),
                    $this->getFields(),
                    $this
                );
                $archives[] = $archive;
            }
        }
        return $archives;
    }

    /**
     * @return array
     */
    public function getStartingUrls()
    {
        return $this->startingUrls;
    }

    /**
     * @param array $urls
     * @return void
     */
    public function setStartingUrls($urls)
    {
        $this->startingUrls = $urls;
    }

    /**
     * @return int
     */
    public function getInterval(){
        return $this->getConfigDownload()->getInterval();
    }

    /**
     * @param int|null $interval
     */
    public function setInterval($interval)
    {
        $this->getConfigDownload()->setInterval($interval);
    }

    /**
     * @return string|null
     */
    public function getUserAgent(){
        return $this->getConfigDownload()->getUserAgent();
    }

    /**
     * @param null|string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->getConfigDownload()->setUserAgent($userAgent);
    }


    /**
     * @return bool|null
     */
    public function isCookieEnabled(){
        return $this->getConfigDownload()->isCookieEnabled();
    }

    /**
     * @param bool|null $cookieEnabled
     */
    public function setCookieEnabled($cookieEnabled)
    {
        $this->getConfigDownload()->setCookieEnabled($cookieEnabled);
    }

    /**
     * @return string|null
     */
    public function getCookieFile(){
        return $this->getConfigDownload()->getCookieFile();
    }

    /**
     * @param null|string $cookieFile
     */
    public function setCookieFile($cookieFile)
    {
        $this->getConfigDownload()->setCookieFile($cookieFile);
    }

    /**
     * @return bool|null
     */
    public function isJsBlocked(){
        return $this->getConfigDownload()->isJsBlocked();
    }

    /**
     * @param bool|null $jsBlocked
     */
    public function setJsBlocked($jsBlocked)
    {
        $this->getConfigDownload()->setJsBlocked($jsBlocked);
    }

    /**
     * @return ConfigDownload
     */
    protected function getConfigDownload()
    {
        return $this->configDownload;
    }

    /**
     * @param ConfigDownload $configDownload
     */
    protected function setConfigDownload($configDownload)
    {
        $this->configDownload = $configDownload;
    }

    /**
     * @param mixed $itemsSelectors
     */
    protected function setItemsSelectors($itemsSelectors)
    {
        $this->itemsSelectors = $itemsSelectors;
    }

    /**
     * @param mixed $nextpageSelectors
     */
    protected function setNextpageSelectors($nextpageSelectors)
    {
        $this->nextpageSelectors = $nextpageSelectors;
    }

    /**
     * @param mixed $fields
     */
    protected function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    protected function getItemsSelectors()
    {
        return $this->itemsSelectors;
    }

    /**
     * @return mixed
     */
    protected function getNextpageSelectors()
    {
        return $this->nextpageSelectors;
    }

    /**
     * @return mixed
     */
    protected function getFields()
    {
        return $this->fields;
    }

}