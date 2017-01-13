<?php
namespace Crawler\Single\Fields;

use Crawler\Single\Fields\Field;
use Crawler\Utils\XpathQueryBuilder;

class FieldAttribute extends Field {

    /**
     * @var string
     */
    protected $attributeName;

    /**
     * @return string
     */
    public function getAttribute()
    {
        $xpath = $this->getXpath();
        $builder = new XpathQueryBuilder();
        $query = $builder->addQueryBySelectors($this->getSelectors())->getQuery();
        $elements = $xpath->query($query);
        $string = array();
        for ($i = 0; $i < $elements->length; $i++) {
            $value = null;
            $valueObj = $elements->item($i)->attributes->getNamedItem($this->getAttributeName());
            if($valueObj != null){
                $value = $valueObj->nodeValue;
                foreach($this->getRewrites() as $rewrite){
                    $value = $rewrite->convertValue($value);
                }
            }
            $string[] = trim($value);
        }
        if (!$this->isMultiple() && count($string) > 0) {
            $string = $string[0];
        }
        return $string;
    }

    /**
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * @param string $attributeName
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;
    }

    public function getExport()
    {
        return array(
            $this->getName() => $this->getAttribute()
        );
    }

}