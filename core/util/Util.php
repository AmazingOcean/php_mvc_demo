<?php

use function PHPSTORM_META\type;

class Utils {

    //获取路径下所有文件
    public static function readerFiles($path) {
        $files = array();
        $type = gettype($path);
        switch($type){
            case "array": 
                foreach($path as $ele){
                    $files = array_merge($files,self::readerFiles($ele));
                }
                break;
            case "string":
                $files = self::readerFilesByFolder($path);
                break;
        }
        return $files;
    }

    //过滤路径内其余字符串
    public static function filterClass($filePath) {
        $strings = explode("\\",$filePath);
        return str_replace(".php","",$strings[count($strings) - 1]);
    }

    //读取文件夹下所有文件
    public static function readerFilesByFolder($path) {

        //判断目录是否为空
        if (!file_exists($path)) {
            return [];
        }

        $files = scandir($path);
        $fileItem = [];
        foreach ($files as $v) {
            $newPath = $path . DIRECTORY_SEPARATOR . $v;
            if (is_dir($newPath) && $v != '.' && $v != '..') {
                $fileItem = array_merge($fileItem, self::readerFiles($newPath));
            } else if (is_file($newPath)) {
                $fileItem[] = $newPath;
            }
        }

        return $fileItem;
    }

}