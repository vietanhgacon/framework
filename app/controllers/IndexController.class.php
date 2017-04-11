<?php
namespace app\controllers;
use framework\core\Controller;

class IndexController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'index2';

        //$userModel = new UserModel("user");
        $tieude = 'Hahahahaha';
        //$users = $userModel->getUsers();
        $users  = 'hahaha';
        // Load View template
        return $this->render('index', ['users' => $users, 'tieude' => $tieude]);
        //include CURR_VIEW_PATH."index.html";
    }
}