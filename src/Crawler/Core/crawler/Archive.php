<?php
class Archive extends Crawler {

    /**
     * @var array|null
     */
    protected $items;

    /**
     * @var string
     */
    protected $nextPageUrl;

    /**
     * @var
     */
    protected $countPages;

    /**
     * @return array
     */
    public function getItems()
    {
        if(!isset($this->items)){
            $this->items = array();
            $xpathQueryBuilder = new XpathQueryBuilder();
            foreach($this->getConfigurationHandler()->getConfigurationArchive()->getItemsSelectors() as $selector){
                switch ($selector->type){
                    case "tagname":
                        $xpathQueryBuilder->addQuery($selector->tagname);
                        break;
                    case "class":
                        $xpathQueryBuilder->addQueryByClass($selector->class);
                        break;
                }
            }
            $elements = $this->getDomXpath()->query($xpathQueryBuilder->getQuery());
            if($elements->length > 0){
                for($i = 0; $i < $elements->length; $i++){
                    $this->items[] = new Single($this->parseUrl($elements->item($i)->attributes->getNamedItem("href")->nodeValue), $this->getConfigurationHandler());
                }
            }
        }
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getNextPageUrl()
    {
        if(!isset($this->nextPageUrl)){
            $xpathQueryBuilder = new XpathQueryBuilder();
            foreach($this->getConfigurationHandler()->getConfigurationArchive()->getNextpageSelectors() as $selector){
                switch ($selector->type){
                    case "tagname":
                        $xpathQueryBuilder->addQuery($selector->tagname);
                        break;
                    case "class":
                        $xpathQueryBuilder->addQueryByClass($selector->class);
                        break;
                    case "id":
                        $xpathQueryBuilder->addQueryById($selector->id);
                        break;
                }
            }
            $elements = $this->getDomXpath()->query($xpathQueryBuilder->getQuery());
            $this->setNextPageUrl(null);
            if($elements->length > 0){
                $hrefObj = $elements->item(0)->attributes->getNamedItem("href");
                if($hrefObj != null){
                    $this->setNextPageUrl($this->parseUrl($hrefObj->nodeValue));
                }
            }
        }
        return $this->nextPageUrl;
    }

    /**
     * @param string $nextPageUrl
     */
    public function setNextPageUrl($nextPageUrl)
    {
        $this->nextPageUrl = $nextPageUrl;
    }

    /**
     * @return int
     */
    public function getCountPages()
    {
        if(!isset($this->countPages)){
//            $xpathQueryBuilder = new XpathQueryBuilder();
//            $xpathQueryBuilder->addQueryByClass();
//            $elements = $this->getDomXpath()->query($xpathQueryBuilder->getQuery());
        }
        return $this->countPages;
    }

    /**
     * @param int $countPages
     */
    public function setCountPages($countPages)
    {
        $this->countPages = $countPages;
    }
}