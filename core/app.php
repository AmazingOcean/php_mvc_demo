<?php

use core\lib\controller\intercpt\IntercptStatic;
use core\lib\exception\ClassNotObjectException;
use core\lib\exception\MVCException;

class Application
{

    public static $center;

    //初始化程序
    public function _initial()
    {

        require("./core/util/Util.php");
        require("./core/app/Center.php");
        require("./core/app/AotoLoadClass.php");

        //全局配置文件
        define("GLOBAL_CONFIG", include("./config/Config.php"));
        //数据库配置
        define("DATABASE", include("./config/DataBase.php"));
        //lib自动注入
        AutoLoadClass::loadClass();
        AutoLoadClass::loadApplicationClass();
        // 拦截器自动注入
        IntercptStatic::loadApplicationClass();

        //路由器资源刷新
        Route::__refresh();

        //程序资源初始化
        Application::$center = new Center();
        Application::$center->__initial();

        //控制器工厂初始化
        ControllerFactory::instanceClass();
        return $this;
    }

    //处理请求
    public function distribute()
    {
        try {
            //拦截器筛选拦截
            $unifyBool = IntercptStatic::unify();
            //如果没有控制器拦截则放行
            if (!$unifyBool) {
                $obj = $this->send();
                $objType = gettype($obj);


                //如果返回对象是object 
                if ($objType == "object") {
                    //如果是视图 那么就托管给Parser对象解析视图数据
                    $classObject = new ClassObject($obj);
                    if ($classObject->name == "ViewModel") {
                        $viewParser = new ViewParser($obj);
                        $viewParser->parser();
                    } else {
                        echo $obj;
                    }
                } else {
                    echo $obj;
                }
            }
        } catch (MVCException $e) {
            echo $e->parserHandler()->abnormalHTML($e);
        }
    }

    //数据放行
    public function send()
    {
        //获取控制器类名
        $className = ControllerFactory::$instance->findControllerClass();
        //初始化控制器
        $controller = new $className;
        $reflectionClass = new ReflectionClass($controller);
        $hasMethod = $reflectionClass->hasMethod(Route::$context->func);
        //如果有这个方法
        if ($hasMethod) {
            //invoke方法
            $method = $reflectionClass->getMethod(Route::$context->func);
            return $method->invoke($controller);
        } else {
            throw new ClassNotObjectException("无效的控制器入口 " . Route::$context->func);
        }
    }
}
