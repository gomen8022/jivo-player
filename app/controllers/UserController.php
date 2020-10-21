<?php

namespace App\Controller;

use App\ControllerBase;
use App\Model\UserModel;

class UserController extends ControllerBase {

    protected $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = $this->container->get(UserModel::class);
    }

    public function login()
    {
        $bool = false;
        $post = json_decode(file_get_contents("php://input"), true);
        $checkUser = $this->userModel->check($post['name'], $post['password']);
        if (!isset($_SESSION) && $checkUser) {
            session_start();
            $_SESSION['login'] = true;
            $bool = true;
        }

        return $bool;
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['login']);
        header("Location: http://jivoplayer.ru");
        die();
    }

    public function main(){
        $data = [];
        session_start();
        $data['session_id'] = $_SESSION['login'];

        return $data;
    }
}
