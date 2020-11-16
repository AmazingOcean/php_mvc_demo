<?php

namespace core\controller;

abstract class BaseController
{

    public function global_config()
    {
        return GLOBAL_CONFIG::class;
    }
}
