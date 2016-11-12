<?php
namespace Crawler\Content;

class WebContentHandler implements IWebContentHandler
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
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * @var \DOMXPath
     */
    protected $domXpath;

    /**
     * @var int
     */
    protected $type;

    /**
     * WebContentHandler constructor.
     * @param string $url
     * @param int $type
     */
    public function __construct($url, $type = WebContentType::PAGE)
    {
        $this->setUrl($url);
        $this->setType($type);
    }


    /**
     * @return string
     */
    public function getContent()
    {
        if(!isset($this->content)){
            switch ($this->getType()){
                case WebContentType::PAGE:
                    $fileSystemHandler = new FileSystem\CacheSystemHandler($this->getUrl());
                    break;
                case WebContentType::IMAGE:
                    $fileSystemHandler = new FileSystem\ImagesSystemHandler($this->getUrl());
                    break;
            }
            if($fileSystemHandler->isFileDownloaded()){
                $content = $this->fetchCachedContent($fileSystemHandler->getFilePath());
            } else {
                $content = $this->downloadContent();
                $fileSystemHandler->saveContent($content);
            }
            $this->setContent($content);
        }
        return $this->content;
    }

    /**
     * @return \DOMDocument
     */
    public function getDomDocument()
    {
        if(!isset($this->domDocument)){
            $dom = new DOMDocument();
            @$dom->loadHTML($this->getContent());
            $this->setDomDocument($dom);
        }
        return $this->domDocument;
    }

    /**
     * @return \DOMXPath
     */
    public function getDomXpath()
    {
        if(!isset($this->domXpath)){
            $this->setDomXpath(new DOMXPath($this->getDomDocument()));
        }
        return $this->domXpath;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * @param string $path
     * @return string
     */
    protected function fetchCachedContent($path){
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
     * @param \DOMDocument $domDocument
     */
    protected function setDomDocument($domDocument)
    {
        $this->domDocument = $domDocument;
    }

    /**
     * @param \DOMXPath $domXpath
     */
    protected function setDomXpath($domXpath)
    {
        $this->domXpath = $domXpath;
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
    protected function setFileSystemHandler($fileSystemHandler)
    {
        $this->fileSystemHandler = $fileSystemHandler;
    }

    /**
     * @return int
     */
    protected function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    protected function setType($type)
    {
        $this->type = $type;
    }
}