<?php
namespace app\model;
// application/models/UserModel.class.php

class UserModel extends \framework\core\Model{


    public function getUsers(){

        $sql = "select * from $this->table";

        $users = $this->db->getAll($sql);

        return $users;

    }

}