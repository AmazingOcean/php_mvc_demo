<?php

class RouterContext {

    public $attributes;
    public $request_url;
    public $method;
    
    public function __construct()
    {
        $this->attributes = $_SERVER['REQUEST_METHOD'] == "GET" ? $_GET : $_POST;
        $this->request_url = $_SERVER["REQUEST_URI"];
        $this->method = $_SERVER['REQUEST_METHOD'];

        // var_dump(ControolerFactory::filterControoler("index/IndexControoler/findName"));
    }

    /**
     * 获取请求信息
     * @path 键名
     */
    public function prototype($path,$def = null){
        $value = $this->method == "GET" ? $_GET[$path] : $_POST[$path];
        return is_null($value) ? $def : $value; 
    }
}
