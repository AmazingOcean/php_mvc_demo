<?php


class ClassObject {

    public $allName;
    public $name;
    
    public function __construct($obj) {
        $this->allName = get_class($obj);
        $strings = explode("\\",$this->allName);
        $this->name = $strings[count($strings) - 1];
    }
    
}