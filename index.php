<?php

header("Content-type:text/html;charset=utf-8");

require  "./core/app.php";

(new Application())->_initial()->distribute();
