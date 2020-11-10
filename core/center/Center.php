<?php 

require("./core/sql/Connection.php");
require("./core/center/Route.php");

class Center
{

    public $connection;

    public function __initial(){

        if (GLOBAL_CONFIG['mysql']){
            $this->connection = new Connection();
            $this->connection->autoLoad();
        }
        Route::__refresh();
    }



}