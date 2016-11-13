<?php
namespace Crawler\Content\FileSystem;

/**
 * Class FileSystemHandler
 * @package Crawler\Content
 */
abstract class FileSystemHandler
{

    /**
     * FileSystemHandler constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->setUrl($url);
    }

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var bool
     */
    protected $hardDirectoring;

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return md5($this->getUrl());
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        $path = $this->getBasePath();
        if ($this->isHardDirectoring()) {
            $path .= $this->getHardDirectory();
        }
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $path .= $this->getFileName();
        return $path;
    }

    /**
     * @param string $path
     * @return void
     */
    public function setBasePath($path)
    {
        $this->setBasePath($path);
    }

    /**
     * @return bool
     */
    public function isFileDownloaded()
    {
        $file = $this->getFilePath();
        if (file_exists($file)) {
            if (is_readable($file)) {
                if (filesize($file) > 0) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $hard
     * @return void
     */
    public function setHardDirectoring($hard)
    {
        $this->hardDirectoring = $hard;
    }

    /**
     * @param string $content
     * @return void
     */
    public function saveContent($content)
    {
        file_put_contents($this->getFilePath(), $content);
    }


    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    protected function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @return string
     */
    protected function getHardDirectory()
    {
        return implode(DIRECTORY_SEPARATOR, str_split(md5($this->getUrl()), 2)) . DIRECTORY_SEPARATOR;
    }

    protected function isHardDirectoring()
    {
        return $this->hardDirectoring;
    }

}