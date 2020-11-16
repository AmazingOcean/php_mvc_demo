<?php

namespace core\lib\exception\parse;

use core\lib\exception\parse\ExceptionParse;
use ClassObject;

class ExceptionParserImpl implements ExceptionParse
{

    public function abnormalHTML($exception)
    {

        $obj = new ClassObject($exception);
        $str = "<h1>" . $obj->name . ": " . $exception->getMessage() . " </h1> <hr />" .
            "<h2> Stack Message: </h2> <br />" . $exception->getTraceAsString();

        return $str;
    }
}
