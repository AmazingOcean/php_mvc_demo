<?php 

require("./core/center/Center.php");

class Application {
    
    public static $center;

    public static function _initial(){

        define("GLOBAL_CONFIG",include("./config/Config.php"));
        define("DATABASE",include("./config/DataBase.php"));
        Application::$center = new Center();
        Application::$center->__initial();
    } 

    public static function demo(){
        return Application::$center->aaa();
    }


}
