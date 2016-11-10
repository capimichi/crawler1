<?php
class SingleFieldString extends SingleField {
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        if(!isset($this->value)){
            $this->value = array();
            $elements = $this->getParent()->getDomXpath()->query($this->getXpathQuery());
            for ($i = 0; $i < $elements->length; $i++) {
                $value = $elements->item($i)->nodeValue;
                $this->value[$i] = $value;
            }
            if (!$this->isMultiple() && count($this->value) > 0) {
                $this->setValue($this->value[0]);
            }
        }
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getExport(){
        return array(
            $this->getName() => $this->getValue()
        );
    }


}