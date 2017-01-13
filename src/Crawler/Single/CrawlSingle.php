<?php
namespace Crawler\Single;

use Crawler\CrawlObject;

class CrawlSingle extends CrawlObject {

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var string|bool
     */
    protected $urlKeyName;

    /**
     * @var array
     */
    protected $externalFields;

    public function __construct()
    {
        $this->setUrlKeyName(false);
        $this->setExternalFields(array());
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
        $export = array();
        if($this->getUrlKeyName()){
            $export[$this->getUrlKeyName()] = $this->getUrl();
        }
        foreach($this->getFields() as $field){
            foreach($field->getExport() as $key => $value){
                $export[$key] = $value;
            }
        }
        foreach($this->getExternalFields() as $key => $value){
            $export[$key] = $value;
        }
        return $export;
    }

    /**
     * @return string|bool
     */
    public function getUrlKeyName()
    {
        return $this->urlKeyName;
    }

    /**
     * @param string|bool $urlKeyName
     */
    public function setUrlKeyName($urlKeyName)
    {
        $this->urlKeyName = $urlKeyName;
    }

    /**
     * @return array
     */
    public function getExternalFields()
    {
        return $this->externalFields;
    }

    /**
     * @param array $externalFields
     */
    public function setExternalFields($externalFields)
    {
        $this->externalFields = $externalFields;
    }
}