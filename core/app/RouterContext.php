<?php

class RouterContext {

    //POST GET 熟悉容器
    public $attributes = array();
    //全URL
    public $request_url;
    //请求方法
    public $method;
    //控制器方法
    public $func;
    //控制器
    public $controller;
    
    public function __construct()
    {
        $this->attributes = $_SERVER['REQUEST_METHOD'] == "GET" ? $_GET : $_POST;
        $this->request_url = $this->redirect();
        $this->method = $_SERVER['REQUEST_METHOD'];

        $strings = explode("/", $this->request_url);
        $lastSize = count($strings) - 1;
        $this->func = $strings[$lastSize];
        $this->controller = str_replace("/". $this->func ,"",$this->request_url);
    }

    public function redirect(){
        $string = explode("?",$_SERVER["REQUEST_URI"])[0];
        $redirs = GLOBAL_CONFIG["router"]["redirect"];
        
        foreach ($redirs as $key => $value){
            if (preg_match($key,$string) == 1){
                $string = $value;
            break;
            }
        }
        return $string;
    }

    /**
     * 获取请求信息
     * @path 键名
     * @param $path
     * @param null $def
     * @return mixed|null
     */
    public function prototype($path,$def = null){
        $value = $this->method == "GET" ? $_GET[$path] : $_POST[$path];
        return is_null($value) ? $def : $value; 
    }
}
