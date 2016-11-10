<?php
class SingleFieldUrl extends SingleField {

    protected $url;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        if(!isset($this->url)){
            $this->url = array();
            $elements = $this->getParent()->getDomXpath()->query($this->getXpathQuery());
            for ($i = 0; $i < $elements->length; $i++) {
                $url = null;
                $urlObj = $elements->item($i)->attributes->getNamedItem("href");
                if($urlObj != null){
                    $url = $this->getParent()->parseUrl($urlObj->nodeValue);
                }
                $this->url[$i] = $url;
            }
            if (!$this->isMultiple()) {
                $this->setUrl($this->url[0]);
            }
        }
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getExport(){
        return array(
            $this->getName() => $this->getUrl()
        );
    }

}