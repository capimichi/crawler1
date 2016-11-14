<?php
namespace Crawler\Single\Fields;

use Crawler\Content\WebContentImage;
use Crawler\Single\Fields\Field;
use Crawler\Utils\XpathQueryBuilder;

class FieldImage extends Field {

    /**
     * @return string
     */
    public function getSrc()
    {
        $xpath = $this->getXpath();
        $builder = new XpathQueryBuilder();
        $query = $builder->addQueryBySelectors($this->getSelectors())->getQuery();
        $elements = $xpath->query($query);
        $src = array();
        for ($i = 0; $i < $elements->length; $i++) {
            $imageUrl = null;
            $srcObj = $elements->item($i)->attributes->getNamedItem("src");
            if($srcObj != null){
                $imageUrl = $this->parseUrl($srcObj->nodeValue);
                $webContentImage = new WebContentImage($imageUrl);
                $imageContent = $webContentImage->getContent();
            }
            $src[] = $imageUrl;
        }
        if (!$this->isMultiple() && count($src) > 0) {
            $src = $src[0];
        }
        return $src;
    }

    /**
     * @return string
     */
    public function getDownloadedImage()
    {
        $src = $this->getSrc();
        $downloaded = array();
        if(is_array($src)){
            foreach($src as $imageUrl){
                $ish = new WebContentImage($imageUrl);
                $downloaded[] = $ish->getFilePath();
            }
        } else {
            $ish = new WebContentImage($src);
            $downloaded = $ish->getFilePath();
        }
        return $downloaded;
    }


    public function getExport()
    {
        return array(
            $this->getName() => $this->getSrc(),
            $this->getName()."-downloaded" => $this->getDownloadedImage()
        );
    }


}