<?php


class AutoLoadClass {

    /**
     * 自动注入core/lib模块类
     */
    public static function loadClass(){
        self::loadClassByFiles(Utils::readerFiles("./core/lib"));
    }

    public static function loadApplicationClass(){
        // 模型对象
        self::loadClassByFiles(Utils::readerFiles(GLOBAL_CONFIG["application"]["model"]));
    }

    public static function loadClassByFiles($files) {
        foreach($files as $file){
            require_once $file;
        }
    }

}