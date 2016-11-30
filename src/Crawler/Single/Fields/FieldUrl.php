<?php
namespace Crawler\Single\Fields;

use Crawler\Single\Fields\Field;
use Crawler\Utils\XpathQueryBuilder;

class FieldUrl extends Field {

    /**
     * @return string
     */
    public function getUrl()
    {
        $xpath = $this->getXpath();
        $builder = new XpathQueryBuilder();
        $query = $builder->addQueryBySelectors($this->getSelectors())->getQuery();
        $elements = $xpath->query($query);
        $urls = array();
        for ($i = 0; $i < $elements->length; $i++) {
            $url = null;
            $urlObj = $elements->item($i)->attributes->getNamedItem("href");
            if($urlObj != null){
                $url = $this->parseUrl($urlObj->nodeValue);
                foreach($this->getRewrites() as $rewrite){
                    $url = $rewrite->convertValue($url);
                }
            }
            $urls[] = $url;
        }
        if (!$this->isMultiple() && count($urls) > 0) {
            $urls = $urls[0];
        }
        return $urls;
    }

    /**
     * @return array
     */
    public function getExport()
    {
        return array(
            $this->getName() => $this->getUrl()
        );
    }
}