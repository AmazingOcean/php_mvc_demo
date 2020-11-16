<?php

return [
    // 启动MySql服务
    "mysql"                     => false,
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
    ],
    "router"            => [
        # url映射控制器是否强类型
        "url_match_rule"     => false
    ]
];
