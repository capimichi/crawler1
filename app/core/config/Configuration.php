<?php
abstract class Configuration{
    protected $configuration;

    public function __construct($configuration)
    {
        $this->setConfiguration($configuration);
    }

    /**
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param mixed $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }
}