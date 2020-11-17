<?php

class Connection {

    public $connect;

    public function autoLoad(){
        $this->connect = new mysqli(DATABASE['ip'],DATABASE['username'],DATABASE['password'],DATABASE['database']);
    }

    public function executeSql($sql){
        return $this->connect->query($sql);
    }
}