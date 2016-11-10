<?php

/**
 * Class ConfigurationHandler
 */
class ConfigurationHandler{
    /**
     * @var object
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var ConfigurationArchive
     */
    protected $configurationArchive;

    /**
     * @var ConfigurationSingle
     */
    protected $configurationSingle;

    /**
     * @var ConfigurationDownload
     */
    protected $configurationDownload;

    /**
     * @var ConfigurationLocale
     */
    protected $configurationLocale;

    public function __construct( $path )
    {
        $this->setPath($path);
    }

    /**
     * @param $path
     * @return null|string
     */
    protected function readFile( $path ){
        if(file_exists($path)){
            $file = file_get_contents($path);
            if($file !== false){
                return $file;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $content
     * @return object|null
     */
    protected function parseJson( $content ){
        $json = json_decode($content);
        if( json_last_error() === JSON_ERROR_NONE){
            return $json;
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return object
     */
    public function getConfiguration()
    {
        if(!isset($this->configuration)){
            $file = $this->readFile($this->getPath());
            if($file){
                $json = $this->parseJson($file);
                if($json){
                    $this->setConfiguration($json);
                }
            }
        }
        return $this->configuration;
    }

    /**
     * @param object $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return ConfigurationArchive
     */
    public function getConfigurationArchive()
    {
        if(!isset($this->configurationArchive)){
            $this->setConfigurationArchive(new ConfigurationArchive($this->getConfiguration()));
        }
        return $this->configurationArchive;
    }

    /**
     * @param ConfigurationArchive $configurationArchive
     */
    public function setConfigurationArchive($configurationArchive)
    {
        $this->configurationArchive = $configurationArchive;
    }

    /**
     * @return ConfigurationSingle
     */
    public function getConfigurationSingle()
    {
        if(!isset($this->configurationSingle)){
            $this->setConfigurationSingle(new ConfigurationSingle($this->getConfiguration()));
        }
        return $this->configurationSingle;
    }

    /**
     * @param ConfigurationSingle $configurationSingle
     */
    public function setConfigurationSingle($configurationSingle)
    {
        $this->configurationSingle = $configurationSingle;
    }

    /**
     * @return ConfigurationDownload
     */
    public function getConfigurationDownload()
    {
        if(!isset($this->configurationDownload)){
            $this->setConfigurationDownload(new ConfigurationDownload($this->getConfiguration()));
        }
        return $this->configurationDownload;
    }

    /**
     * @param ConfigurationDownload $configurationDownload
     */
    public function setConfigurationDownload($configurationDownload)
    {
        $this->configurationDownload = $configurationDownload;
    }

    /**
     * @return ConfigurationLocale
     */
    public function getConfigurationLocale()
    {
        if(!isset($this->configurationLocale)){
            $this->setConfigurationLocale(new ConfigurationLocale($this->getConfiguration()));
        }
        return $this->configurationLocale;
    }

    /**
     * @param ConfigurationLocale $configurationLocale
     */
    public function setConfigurationLocale($configurationLocale)
    {
        $this->configurationLocale = $configurationLocale;
    }


}