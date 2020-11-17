<?php

use core\lib\exception\ViewNotFoundException;

class ViewParser {

    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function parser(){
        $parentPath = GLOBAL_CONFIG["application"]["view"];
        $filePath = $parentPath . $this->model->file;
        if (file_exists($filePath)){
            $renderParser = new ViewRender();
            $renderParser->write($filePath,$this->model->data);
        } else {
            throw new ViewNotFoundException($this->model->file . " 视图不存在");
        }

    }
}

class ViewRender {
    public function write($file,$data){
        // $this->DATA = $data;
        $data["baseDir"] = GLOBAL_CONFIG["application"]["static"];
        extract($data);
        include $file;
    }

}