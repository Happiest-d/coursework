<?php

namespace app\components;

class Counter extends \yii\base\Widget {

    public $array;

    public function init(){}

    public function run() {
        return $this->render('counter', ['res' => count($this->array)]);
    }
}



?>