<?php

class SingleFieldImage extends SingleField
{

    /**
     * @var string
     */
    protected $src;

    /**
     * @var string
     */
    protected $srcFile;

    /**
     * @return string|array
     */
    public function getSrc()
    {
        if(!isset($this->src)){
            $this->src = array();
            $elements = $this->getParent()->getDomXpath()->query($this->getXpathQuery());
            for ($i = 0; $i < $elements->length; $i++) {
                $imageUrl = null;
                $srcObj = $elements->item($i)->attributes->getNamedItem("src");
                if($srcObj != null){
                    $imageUrl = $this->getParent()->parseUrl($srcObj->nodeValue);
                    if ($this->isImageDownloadEnabled()) {
                        $imageLocalPath = $this->getImagePath($imageUrl) . $this->generateImageName($imageUrl);;
                        if (!file_exists($imageLocalPath)) {
                            $image = file_get_contents($imageUrl);
                            $f = fopen($imageLocalPath, "w");
                            fwrite($f, $image);
                            fclose($f);
                        }
                    }
                }
                $this->src[$i] = $imageUrl;
            }
            if (!$this->isMultiple() && count($this->src) > 0) {
                $this->setSrc($this->src[0]);
            }
        }
        return $this->src;
    }

    /**
     * @param string|array $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return string|array
     */
    public function getSrcFile()
    {
        if(!isset($this->srcFile)){
            $this->srcFile = array();
            if($this->isMultiple()){
                foreach($this->getSrc() as $src){
                    $this->srcFile[] = $this->getImagePath($src) . $this->generateImageName($src);
                }
            } else {
                if(!empty($this->getSrc())){
                    $this->setSrcFile($this->getImagePath($this->getSrc()) . $this->generateImageName($this->getSrc()));
                }
            }
        }

        return $this->srcFile;
    }

    /**
     * @param string|array $srcFile
     */
    public function setSrcFile($srcFile)
    {
        $this->srcFile = $srcFile;
    }

    protected function isImageDownloadEnabled()
    {
        return $this->getParent()->getConfigurationHandler()->getConfigurationLocale()->isImagesEnabled();
    }

    protected function getImagePath($url)
    {
        $path = $this->getParent()->getConfigurationHandler()->getConfigurationLocale()->getImagesPath();
        $path .= implode(DIRECTORY_SEPARATOR, str_split(md5($url), 2)) . DIRECTORY_SEPARATOR;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    protected function generateImageName($url)
    {
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $url);
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        $file = $file;
        return $file;
    }

    /**
     * @return array
     */
    public function getExport(){
        $returnArray = array(
            $this->getName() => $this->getSrc(),
        );
        if($this->isImageDownloadEnabled()){
            $returnArray[$this->getName() . "-downloaded"] = $this->getSrcFile();
        }
        return $returnArray;
    }
}