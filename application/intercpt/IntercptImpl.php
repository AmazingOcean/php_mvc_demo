<?php

use core\lib\controller\intercpt\Intercept;

class IntercptImpl implements Intercept {

    function handler() {
        // var_dump("IntercptImpl");
        return false;
    }

    public function patternUrl()
    {
        return "[/*]";
    }
    

}