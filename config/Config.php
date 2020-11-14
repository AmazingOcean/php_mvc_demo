<?php

return [
    // 启动MySql服务
    "mysql"             => false,
    // Debug 模式
    "debug"             => true,
    // 应用配置
    "application"       => [
        
        # 控制器
        "controller"        =>  ".\application\controller" 
    ],
    "router"            => [
        # url映射控制器是否强类型
        "url_match_rule"     => false
    ]
];

    

