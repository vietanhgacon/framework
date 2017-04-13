<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\CustomerModel;
class IndexController extends Controller
{

    public function actionIndex()
    {
        $model = new CustomerModel('customers');
        //$model->getTable();
        
        $this->layout = 'index';
        return $this->render('index');
    }

    public function actionHeader(){
        return $this->renderBlock('header');
    }
}