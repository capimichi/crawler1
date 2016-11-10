<?php
class ConsoleHandler{

    /**
     * @var object
     */
    protected $config;


    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * @return array
     */
    public function readSelectors(){
        $selectors = array();
        do{
            echo "Insert selector type [tagname|class] or empty to stop: ";
            $newSelectorType = readline();
            if(!empty($newSelectorType)){
                echo "Insert selector {$newSelectorType}: ";
                $newSelectorValue = readline();
                $selectors[] = array(
                    'type' => $newSelectorType,
                    $newSelectorType => $newSelectorValue
                );
            }
        } while(!empty($newSelectorType));
        return $selectors;
    }

    public function addField(){
        echo "Insert field name: ";
        $name = readline();
        $fieldFound = false;
        foreach($this->getConfig()->single->fields as $field){
            if($field->name == $name){
                $fieldFound = true;
            }
        }
        if(!$fieldFound){
            echo "Insert field type [string|url|image]: ";
            $type = readline();
            echo "Is field multiple: [true|false]: ";
            $multiple = readline();
            if($multiple == "true"){
                $multiple = true;
            } else {
                $multiple = false;
            }
            $selectors = $this->readSelectors();
            array_push($this->getConfig()->single->fields, array(
                'name' => $name,
                'type' => $type,
                'multiple' => $multiple,
                'selectors' => $selectors
            ));
        } else {
            echo "Error: Field already present\n";
        }
        return $this->getConfig();
    }

    public function removeField(){
        echo "Insert field name: ";
        $name = readline();
        $fieldFound = false;
        foreach($this->getConfig()->single->fields as $key => $field){
            if($field->name == $name){
                unset($this->config->single->fields[$key]);
                $fieldFound = true;
            }
        }
        if(!$fieldFound){
            echo "Error: Field not found\n";
        }
        return $this->getConfig();
    }

    public function editArchiveItems(){
        $selectors = $this->readSelectors();
        $this->config->archive->items->selectors = $selectors;
        return $this->getConfig();
    }

    public function editArchiveNextpage(){
        $selectors = $this->readSelectors();
        $this->config->archive->nextpage->selectors = $selectors;
        return $this->getConfig();
    }

    public function clearCache(){
        $this->deleteDirectory($this->getConfig()->cache->path);
        mkdir($this->getConfig()->cache->path);
    }

    public function clearHtml(){
        $this->deleteDirectory($this->getConfig()->html->path);
        mkdir($this->getConfig()->html->path);
    }

    public function clearImages(){
        $this->deleteDirectory($this->getConfig()->images->path);
        mkdir($this->getConfig()->images->path);
    }

    protected function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    /**
     * @return object
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param object $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }


}