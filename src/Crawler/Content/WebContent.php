<?php
namespace Crawler\Content;

use Crawler\Content\FileSystem\IFileSystemHandler;

abstract class WebContent implements IWebContent
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var IFileSystemHandler
     */
    protected $fileSystemHandler;

    /**
     * WebContent constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->setUrl($url);
    }



    public function getContent()
    {
        $fsHandler = $this->getFileSystemHandler();
        if(!isset($this->content)){
            if($fsHandler->isFileDownloaded()){
                $content = $this->fetchCachedContent($fsHandler->getFilePath());
            } else {
                $content = $this->downloadContent();
                $this->saveContent();
            }
            $this->setContent($content);
        }
        return $this->content;
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
     * @param IFileSystemHandler $fileSystemHandler
     */
    public function setFileSystemHandler($fileSystemHandler)
    {
        $this->fileSystemHandler = $fileSystemHandler;
    }

    protected function saveContent()
    {

    }

    /**
     * @param string $path
     * @return string
     */
    protected function fetchCachedContent($path)
    {
        $content = file_get_contents($path);
        return $content;
    }

    /**
     * @return string|bool
     */
    protected function downloadContent()
    {
        $url = $this->getUrl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.coms/bot.html)");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);


//        curl_setopt($ch, CURLOPT_COOKIE, true);
//        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
//        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);

        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    /**
     * @param string $content
     */
    protected function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return IFileSystemHandler
     */
    protected function getFileSystemHandler()
    {
        return $this->fileSystemHandler;
    }
}