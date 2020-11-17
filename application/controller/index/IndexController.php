<?php

use core\controller\BaseController;
use core\lib\sql\SqlBuilder;
use core\lib\view\ViewModel;

class IndexController extends BaseController {
    
    public function demo() {
        $builder = new SqlBuilder("user");
        // 查询数据
        $res = $builder->execute("select * from users")->inject(User::class);
        $view = new ViewModel("index.php");
        $view->addData("result",$res)->addData("title","首页");
        return $view;
    }

}
