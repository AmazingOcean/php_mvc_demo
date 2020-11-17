<?php

return [
    // 启动MySql服务
    "mysql"                     => true,
    // Debug 模式
    "debug"                     => true,
    // 异常配置
    "exception"         => [

    ],
    // 应用配置
    "application"       => [

        # 控制器识别路径
        "controller"        =>  ".\application\controller",
        # 拦截器识别路径
        "intercpt"          =>  [
            ".\application\intercpt"
        ],
        "view"              =>  ".\public\\",
        # 对象模型
        "model"             =>  [
            ".\application\model"
        ],
        # 静态资源放行
        "static"   => "./public/static"
    ],
    "router"            => [
        # url映射控制器是否强类型
        "url_match_rule"        => false,
        # 重定向
        "redirect"              => [
            "[/$]"         => "/index/index/demo"
        ],
    ]
];
