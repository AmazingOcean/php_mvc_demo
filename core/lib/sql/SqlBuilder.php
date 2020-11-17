<?php 

namespace core\lib\sql;

use Application;

class SqlBuilder {

    public $con;
    public $sql;
    public $result;

    public function __construct(){
        $this->con = Application::$center->connection;
    }

    public function execute($sql){
        $this->sql = $sql;
        return $this;
    }

    public function result(){
        $res = $this->con->executeSql($this->sql);
        $arr = array();

        if ($res->num_rows > 0){
            while ($row = $res->fetch_assoc()){
                array_push($arr,$row);
            }
        }

        $this->result = $arr;
        return $arr;
    }

    public function inject($class){
        if (empty($this->result)){
            $this->result = $this->result();
        }
        $models = array();

        foreach ($this->result as $value){
            array_push($models,$this->injectObject(new $class,$value));

        }
        return $models;
    }

    public function injectObject($obj,$arr){
        foreach ($arr as $key=>$value){
            $obj->$key = $value;
        }
        return $obj;
    }

}

