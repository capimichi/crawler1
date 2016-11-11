<?php
namespace Crawler\Config;

/**
 * Class ConfigObject
 * @package Crawler\Config
 */
abstract class ConfigObject{

    /**
     * @var object
     */
    protected $configuration;

    public function __construct( $configuration )
    {
        $this->configuration = $configuration;
    }

    /**
     * @return object
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param object $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

}