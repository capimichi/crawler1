<?php
namespace Crawler\Config;

/**
 * Class ConfigHandler
 * @package Crawler\Config
 */
class ConfigHandler{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var ConfigArchive
     */
    protected $configArchive;

    /**
     * @var ConfigDownload
     */
    protected $configDownload;

    /**
     * @var ConfigGeneral
     */
    protected $configGeneral;

    /**
     * @var ConfigLocale
     */
    protected $configLocale;

    /**
     * @var ConfigSingle
     */
    protected $configSingle;

    public function __construct( $path )
    {
        $this->setPath($path);
        $file = $this->readFile($this->getPath());
        if($file){
            $json = $this->parseJson($file);
            if($json){
                $this->setConfigArchive(new ConfigArchive($json));
                $this->setConfigDownload(new ConfigArchive($json));
                $this->setConfigGeneral(new ConfigArchive($json));
                $this->setConfigLocale(new ConfigArchive($json));
                $this->setConfigSingle(new ConfigArchive($json));
            }
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
     * @param $path
     *
     * @throws \Exception
     *
     * @return null|string
     */
    protected function readFile( $path ){
        if(file_exists($path)){
            $file = file_get_contents($path);
            if($file !== false){
                return $file;
            } else {
                throw new \Exception("Cannot read file");
            }
        } else {
            throw new \Exception("File not existing");
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
            throw new \Exception("Json error in configuration");
        }
    }

    /**
     * @return ConfigArchive
     */
    public function getConfigArchive()
    {
        return $this->configArchive;
    }

    /**
     * @param ConfigArchive $configArchive
     */
    public function setConfigArchive($configArchive)
    {
        $this->configArchive = $configArchive;
    }

    /**
     * @return ConfigDownload
     */
    public function getConfigDownload()
    {
        return $this->configDownload;
    }

    /**
     * @param ConfigDownload $configDownload
     */
    public function setConfigDownload($configDownload)
    {
        $this->configDownload = $configDownload;
    }

    /**
     * @return ConfigGeneral
     */
    public function getConfigGeneral()
    {
        return $this->configGeneral;
    }

    /**
     * @param ConfigGeneral $configGeneral
     */
    public function setConfigGeneral($configGeneral)
    {
        $this->configGeneral = $configGeneral;
    }

    /**
     * @return ConfigLocale
     */
    public function getConfigLocale()
    {
        return $this->configLocale;
    }

    /**
     * @param ConfigLocale $configLocale
     */
    public function setConfigLocale($configLocale)
    {
        $this->configLocale = $configLocale;
    }

    /**
     * @return ConfigSingle
     */
    public function getConfigSingle()
    {
        return $this->configSingle;
    }

    /**
     * @param ConfigSingle $configSingle
     */
    public function setConfigSingle($configSingle)
    {
        $this->configSingle = $configSingle;
    }

}