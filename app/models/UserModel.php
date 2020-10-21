<?php

namespace App\Model;

use App\ModelBase;

class UserModel extends ModelBase {

    protected $login;

    public function check($login, $password)
    {
        $this->login = $login;
        $check = $this->db->query("SELECT id FROM users WHERE login = '$login' AND password = '$password'");
        return $check;
    }

}