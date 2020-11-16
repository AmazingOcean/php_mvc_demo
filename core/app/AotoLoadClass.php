<?php


class AutoLoadClass {

    /**
     * 自动注入core/lib模块类
     */
    public static function loadClass(){
        $files = Utils::readerFiles("./core/lib");
        foreach($files as $file){
            require_once $file;
        }
    }

}