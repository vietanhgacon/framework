<?php

namespace app\models;

use framework\core\Model;

class CustomerModel extends Model
{

    public function getTable()
    {
        print_r($this->findAll());
    }
}