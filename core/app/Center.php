<?php 

require("./core/sql/Connection.php");
require("./core/app/Route.php");

class Center
{

    public $connection;

    public function __initial(){

        //数据库连接
        if (GLOBAL_CONFIG['mysql']){
            $this->connection = new Connection();
            $this->connection->autoLoad();
        }
    }
}