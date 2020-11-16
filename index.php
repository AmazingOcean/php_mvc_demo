<?php

header("Content-type:text/html;charset=utf-8");

require dirname(__FILE__) . "/core/app.php";

(new Application())->_initial()->distribute();
