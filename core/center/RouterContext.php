<?php

class RouterContext {

    public $attributes;
    public $request_url;
    
    public function __construct()
    {
        $this->attributes = $_SERVER['REQUEST_METHOD'] == "GET" ? $_GET : $_POST;
        $this->request_url = $_SERVER["REQUEST_URI"];
    }


}
