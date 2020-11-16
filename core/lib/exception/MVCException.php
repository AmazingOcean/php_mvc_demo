<?php
namespace core\lib\exception;

use Exception;
use core\lib\exception\parse\ExceptionParserImpl;

abstract class MVCException extends Exception {

    //返回信息
    public $message;

    public function __construct($message){
        $this->message = $message;
    }

    //错误处理器
    public function parserHandler(){
        return new ExceptionParserImpl();
    }


}