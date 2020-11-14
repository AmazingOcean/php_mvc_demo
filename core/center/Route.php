<?php

require("RouterContext.php");

class Route {

    public static $context;
    
    public static function __refresh(){
        Route::$context = new RouterContext();
        
    }

    public static function __loadUrl(){



    }
    

}