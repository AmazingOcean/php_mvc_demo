<?php



/**
 * 控制器工厂
 */
class ControllerFactory
{

    // 控制器文件缓存区
    private $file_cache = array();
    public static $instance;

    public static function instanceClass(){

        $obj = new ControllerFactory();
        $obj->loadClass();
        ControllerFactory::$instance = $obj;
    }


    /**
     * 加载容器文件缓存 
     */
    public function loadClass() {
        $this->file_cache = Utils::readerFiles(GLOBAL_CONFIG["application"]['controller']);
    }
    
    /**
     * 通过url查看控制器是否存在
     * @param url url连接
     */
    public function containsControllerClass($url){
        return $this->queryControllerClass($url) != null;
    }


    /**
     * 
     * 通过url拿取控制器类
     * @param url class路径
     */
    public function queryControllerClass($url){
        $path = $this->generatorPath($url);
        //如果匹配规则是强类型
        foreach ($this->file_cache as $ele) { 
            $state = false;
            if(GLOBAL_CONFIG['router']['url_match_rule']){
                $state = $ele == $path;
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
    public function findControllerClass()
    {
        $filterRouterResult = Route::$context->controller;
        

        if($this->containsControllerClass($filterRouterResult)){
            $fileName = $this->queryControllerClass($filterRouterResult);
            require_once $fileName;
            return $this->generatorClassNameByFile($fileName);;
        } else {
            throw new \core\lib\exception\ClassNotObjectException("无效的控制器: " . $filterRouterResult);
        }
    }
    

    /**
     * 通过控制器名字获取类名
     * @param file 文件名字
     */
    public function generatorClassNameByFile($file){
        $strings = explode("\\", $file);
        $lastSize = count($strings) - 1;
        return str_replace(".php","",$strings[$lastSize]);
    }

    /**
     * 通过控制器名字生成文件全路径
     * @param class 控制器名字
     */
    public function generatorPath($class) {
        return str_replace("/","\\",GLOBAL_CONFIG["application"]['controller'] . "$class"."Controller.php");
    }

    /**
     * 实例化控制器
     * @param url 通过url实例化控制器
     */
    public function newInstanceController(){
        $path = $this->findControllerClass();
        return new $path;
    }
}
