<?php

class Utils {

    
    public static function readerFiles($path) {
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