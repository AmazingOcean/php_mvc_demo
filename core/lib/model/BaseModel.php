<?php
namespace core\lib\model;

use ClassObject;

class BaseModel {
    
    private $obj;

    public function object(){
        if($this->obj == null){
            $this->obj = new ClassObject($this);
        }
        return $this->obj;
    }

    public function table(){
        return strtolower($this->object()->name);
    }

}