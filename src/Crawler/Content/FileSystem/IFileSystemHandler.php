<?php
namespace Crawler\Content\FileSystem;

/**
 * Interface IFileSystemHandler
 * @package Crawler\Content
 */
interface IFileSystemHandler{

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @return string
     */
    public function getFilePath();

    /**
     * @param string $path
     * @return void
     */
    public function setBasePath($path);

    /**
     * @param $hard
     * @return void
     */
    public function setHardDirectoring($hard);

    /**
     * @return bool
     */
    public function isFileDownloaded();

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url);

    /**
     * @param string $content
     * @return void
     */
    public function saveContent($content);

}