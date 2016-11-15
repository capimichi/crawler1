<?php
namespace Crawler\Single;

use Crawler\CrawlObject;

class CrawlSingle extends CrawlObject {

    /**
     * @var array
     */
    protected $fields;

    public function __construct()
    {

    }
//    public function __construct($url, $fields)
//    {
//        $this->setFields(unserialize(serialize($fields)));
//        for($i = 0; $i < count($this->fields); $i++){
//            $this->fields[$i]->setCrawlSingle($this);
//        }
//    }

    /**
     * @param array $fields
     * @return void
     */
    public function setFields($fields)
    {
        if(count($fields) > 0){
            $fields = unserialize(serialize($fields));
            foreach($fields as $field){
                $field->setCrawlSingle($this);
            }
        }
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getExport()
    {
        $export = array(
            'url' => $this->getUrl()
        );
        foreach($this->getFields() as $field){
            foreach($field->getExport() as $key => $value){
                $export[$key] = $value;
            }
        }
        return $export;
    }
}