<?php



/**
 * 控制器工厂
 */
class ControolerFactory
{

    // 控制器文件缓存区
    public static $file_cache = array();

    /**
     * 加载容器文件缓存 
     */
    public static function loadClass() {
        self::$file_cache = Utils::readerFiles(GLOBAL_CONFIG["application"]['controller']);
    }
    
    /**
     * 通过url查看控制器是否存在
     * @param url url连接
     */
    public static function containsControllerClass($url){
        return self::queryControllerClass($url) != null;
    }


    /**
     * 
     * 通过url拿取控制器类
     * @param url class路径
     */
    public static function queryControllerClass($url){
        $path = self::generatorPath($url);
        //如果匹配规则是强类型
        foreach (self::$file_cache as $ele) { 
            $state = false;
            if(GLOBAL_CONFIG['router']['url_match_rule']){
                $state = $ele == $ele;
            } else {
                $state = strtolower($ele) == strtolower($path);
            }
            if ($state){
                return $ele;
            }
        }
    }

    /**
     * 获取控制器Class
     * @param url 通过完整的url获取
     */
    public static function findControolerClass($url)
    {
        $strings = explode("/", $url);
        $lastSize = count($strings) - 1;
        $method = $strings[$lastSize];
        $filterRouterResult = str_replace("/".$method,"",$url);
        if(self::containsControllerClass($filterRouterResult)){
            $fileName = self::queryControllerClass($filterRouterResult);
            require_once $fileName;
            return self::generatorClassNameByFile($fileName);;
        } else {
            return null;
        }
    }



    /**
     * 通过控制器名字获取类名
     * @param file 文件名字
     */
    public static function generatorClassNameByFile($file){
        $strings = explode("\\", $file);
        $lastSize = count($strings) - 1;
        return str_replace(".php","",$strings[$lastSize]);
    }

    /**
     * 
     * 通过控制器名字生成文件全路径
     * @param class 控制器名字
     */
    public static function generatorPath($class) {
        return str_replace("/","\\",GLOBAL_CONFIG["application"]['controller'] . "$class"."Controller.php");
    }

    /**
     * 实例化控制器
     * @param url 通过url实例化控制器
     */
    public static function newInstanceController($url)
    {
        $path = self::findControolerClass($url);
        return new $path;
    }
}
