<?php

namespace core\lib\view;

class ViewModel{

    public $file;
    public $data = array();

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function addData($key,$value){
        $this->data[$key] = $value;
        return $this;
    }

    public function getData($key) {
        return $this->data[$key];
    }
}