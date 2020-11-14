<?php 

require("./core/center/Center.php");

class Application {
    
    public static $center;

    public static function _initial(){

        define("GLOBAL_CONFIG",include("./config/Config.php"));
        define("DATABASE",include("./config/DataBase.php"));

        //引入 ControolerFactory
        require_once("./core/controller/ControolerFactory.php");
        require_once("./core/util/Util.php")

        Application::$center = new Center();
        Application::$center->__initial();

        ControolerFactory::loadClass();
        ControolerFactory::newInstanceController("/index/index/demo");
    } 

    public static function demo(){
        return Application::$center->aaa();
    }


}
