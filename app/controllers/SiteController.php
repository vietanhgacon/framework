<?php

namespace app\controllers;

use framework\core\Controller;

class SiteController extends Controller
{
    public function actionIndex(){
        return $this->renderBlock('footer');
    }
}