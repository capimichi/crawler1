<?php

class CrawlHandler{

    /**
     * @var array
     */
    protected $crawled;

    /**
     * @var array
     */
    protected $urls;

    /**
     * @var array
     */
    protected $archives;

    /**
     * @var ConfigurationHandler
     */
    protected $configurationHandler;

    /**
     * @return array
     */
    public function getUrls()
    {
        if(!isset($this->urls)){
            $this->setUrls(array());
        }
        return $this->urls;
    }

    /**
     * @param array $urls
     */
    public function setUrls($urls)
    {
        $this->urls = $urls;
    }

    /**
     * Load initial urls from the file
     *
     * @param string $file
     */
    public function fetchUrlsFromFile( $file = null ){
        if(!$file){
            $file = dirname(dirname(dirname(__FILE__))) . "/config/urls.txt";
        }
        $urls = str_replace("\n", "", file($file));
        $this->setUrls($urls);
    }

    public function outPut($string, $done = false){
        echo str_pad($string, 100);
        if($done){
            echo "[X]\n";
        } else {
            echo "[ ]\r";
        }
    }

    /**
     * @return array
     */
    public function getArchives()
    {
        if(!isset($this->archives)){
            $this->setArchives(array());
            $this->setCrawled(array());
            foreach($this->getUrls() as $key => $url){
                array_push($this->crawled, $url);
                $this->outPut("Fetching {$url}", false);
                $archive = new Archive($url, $this->getConfigurationHandler());
                $archive->getContent();
                $this->outPut("Fetching {$url}", true);
                array_push($this->archives, $archive);
                while(($newUrl = $archive->getNextPageUrl()) != null && !in_array($newUrl, $this->getCrawled())){
                    $newUrl = $archive->parseUrl($newUrl);
                    array_push($this->crawled, $newUrl);
                    $this->outPut("Fetching {$newUrl}", false);
                    $archive = new Archive($newUrl, $this->getConfigurationHandler());
                    $archive->getContent();
                    $this->outPut("Fetching {$newUrl}", true);
                    array_push($this->archives, $archive);
                }
            }
        }
        return $this->archives;
    }

    /**
     * @param array $archives
     */
    public function setArchives($archives)
    {
        $this->archives = $archives;
    }

    /**
     * @return array
     */
    public function getCrawled()
    {
        if(!isset($this->crawled)){
            $this->crawled = array();
        }
        return $this->crawled;
    }

    /**
     * @param array $crawled
     */
    public function setCrawled($crawled)
    {
        $this->crawled = $crawled;
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
}