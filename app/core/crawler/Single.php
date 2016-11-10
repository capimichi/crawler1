<?php
class Single extends Crawler {

    /**
     * @var array
     */
    protected $fields;

    /**
     * @return array
     */
    public function getFields()
    {
        if(!isset($this->fields)){
            $this->fields = array();
            foreach($this->getConfigurationHandler()->getConfigurationSingle()->getFields() as $f){
                switch ($f->type){
                    case "string":
                        $this->fields[] = new SingleFieldString($f->name, $f->multiple, $f->selectors, $this);
                        break;
                    case "url":
                        $this->fields[] = new SingleFieldUrl($f->name, $f->multiple, $f->selectors, $this);
                        break;
                    case "image":
                        $this->fields[] = new SingleFieldImage($f->name, $f->multiple, $f->selectors, $this);
                        break;
                }
            }
        }
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getExport(){
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