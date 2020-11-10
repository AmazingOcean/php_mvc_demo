<?php

header("Content-type:text/html;charset=utf-8");

require dirname(__FILE__) . "/core/app.php";

Application::_initial();

// var_dump($_SERVER);

var_dump(get_class_methods(Route::class));
// var_dump(Route::$context->attributes);
