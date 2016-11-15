<?php
namespace Crawler\Single\Fields;

use Crawler\Content\WebContentImage;
use Crawler\Content\WebContentImageBuilder;
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
            $tagname = $elements->item($i)->nodeName;
            $attributes = array(
                "img" => "src",
                "a" => "href"
            );
            if($tagname != null){
                $srcObj = $elements->item($i)->attributes->getNamedItem($attributes[$tagname]);
                if($srcObj != null){
                    $imageUrl = $this->parseUrl($srcObj->nodeValue);
                    foreach($this->getRewrites() as $rewrite){
                        $imageUrl = $rewrite->convertValue($imageUrl);
                    }
                    $builder = new WebContentImageBuilder();
                    $webContentImage = $builder->setUrl($imageUrl)->build();
                    $imageContent = $webContentImage->getContent();
                }
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
                $builder = new WebContentImageBuilder();
                $img = $builder->setUrl($imageUrl)->build();
                $downloaded[] = $img->getFilePath();
            }
        } else {
            $builder = new WebContentImageBuilder();
            $img = $builder->setUrl($src)->build();
            $downloaded = $img->getFilePath();
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