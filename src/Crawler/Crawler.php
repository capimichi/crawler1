<?php
namespace Crawler;

use Crawler\Config\ConfigHandler;

class Crawler{

    /**
     * @var Archive\CrawlArchive
     */
    protected $archives;

    /**
     * @var array
     */
    protected $startingUrls;

    /**
     * @var Config\ConfigHandler
     */
    protected $configuration;


    /**
     * Crawler constructor.
     * @param string $configurationPath
     * @throws \Exception
     */
    public function __construct($configurationPath = "DEFAULT")
    {
        if($configurationPath){
            if($configurationPath == "DEFAULT"){
                $configurationPath = dirname(dirname(dirname(__FILE__)))."/app/config/config.json";
            }
            $configurationFile = realpath($configurationPath);
            if(is_readable($configurationFile)){
                $this->setConfiguration(new ConfigHandler($configurationFile));
            } else {
                throw new \Exception("Configuration file {$configurationPath} is not readable");
            }
        }
    }

    /**
     * @return Archive\CrawlArchive
     */
    public function getArchives()
    {
        return $this->archives;
    }

    /**
     * @param Archive\CrawlArchive $archives
     */
    public function setArchives($archives)
    {
        $this->archives = $archives;
    }

    /**
     * @return array
     */
    public function getStartingUrls()
    {
        return $this->startingUrls;
    }

    /**
     * @param array $startingUrls
     */
    public function setStartingUrls($startingUrls)
    {
        $this->startingUrls = $startingUrls;
    }

    /**
     * @return Config\ConfigHandler
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param Config\ConfigHandler $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

}