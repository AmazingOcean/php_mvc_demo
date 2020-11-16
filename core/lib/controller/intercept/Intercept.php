<?php 

namespace core\lib\controller\intercpt;

use Route;
use Utils;

interface Intercept {


    //处理
    function handler();

    //路径匹配
    function patternUrl();

}

class IntercptStatic {

    //拦截器容器
    public static $objs = array();
    
    //注入所有拦截器
    public static function loadApplicationClass(){
        $files = Utils::readerFiles(GLOBAL_CONFIG["application"]["intercpt"]);
        foreach ($files as $ele) {
            # code...
            require_once $ele;
            $className = Utils::filterClass($ele);
            array_push(self::$objs,(new $className));
        }
    }

    //执行拦截器
    public static function unify(){
        $intercpts = self::screen();
        if (!empty($intercpts)){
            foreach ($intercpts as $int) {
                if ($int->handler()) {
                    return true;
                }

            }
        }
        return false;
    }

    //筛选拦截器
    public static function screen(){
        $arr = array();
        foreach(self::$objs as $intercpt) {
            $match = $intercpt->patternUrl();
            
            if(preg_match($match,Route::$context->request_url) == 1){
                array_push($arr,$intercpt);
            }
            
        }
        return $arr;
    }

}