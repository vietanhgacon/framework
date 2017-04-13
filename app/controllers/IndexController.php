<?php

namespace app\controllers;

use framework\core\Controller;

class IndexController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'index';
        return $this->render('index');
    }

    public function actionHeader(){
        return $this->renderBlock('header');
    }
}