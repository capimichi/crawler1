<?php
namespace Crawler\Single\Fields;

use Crawler\Single\Fields\Field;
use Crawler\Utils\XpathQueryBuilder;

class FieldString extends Field {

    /**
     * @return string
     */
    public function getString()
    {
        $xpath = $this->getXpath();
        $builder = new XpathQueryBuilder();
        $query = $builder->addQueryBySelectors($this->getSelectors())->getQuery();
        $elements = $xpath->query($query);
        $string = array();
        for ($i = 0; $i < $elements->length; $i++) {
            $value = $elements->item($i)->nodeValue;
            $string[] = $value;
        }
        if (!$this->isMultiple() && count($string) > 0) {
            $string = $string[0];
        }
        return $string;
    }

    public function getExport()
    {
        return array(
            $this->getName() => $this->getString()
        );
    }

}