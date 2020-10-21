<?php

namespace App\Controller;

use App\ControllerBase;
use App\Model\TaskModel;

class TaskController extends ControllerBase {

    protected $container;
    protected $taskModel;

    public function __construct() {
        parent::__construct();
        $this->taskModel = $this->container->get(TaskModel::class);
    }

    public function add() {
        $data = [];
        if (isset($_FILES)) {
            $file = $this->saveFile($_FILES);
        }
        if (isset($_POST)){
            $this->taskModel->put(
                $_POST['name'],
                $_POST['link'],
                $_FILES['file']['name'],
                $_POST['often'],
                $_POST['unique']
            );
        }
        return $data;
    }

    public function delete() {
        if (isset($_POST)){
            $this->taskModel->delete(
                $_POST['id']
            );
        }

    }

    public function getFile() {
        $all = $this->taskModel->getTasks(1, 'reg_date');
        $rand = rand(0, count($all)-1);
        $media = $all[$rand]['file'];
        return $media;
    }


    public function getLink() {
        $all = $this->taskModel->getTasks(1, 'reg_date');
        $rand = rand(0, count($all)-1);
        $media = $all[$rand]['link'];
        return $media;
    }

    public function edit()
    {
        $bool = false;
//        session_start();
//        $checkLogin = $_SESSION['login'];
        if (isset($_POST)){// && $checkLogin) {
            $this->taskModel->edit($_POST['id'], $_POST['name'], $_POST['file'], $_POST['link'], $_POST['often'], $_POST['unique']);
            $bool = true;
        }
        return $bool;
    }

    public  function main(){
        $data = [];
        session_start();
        $data['session_id'] = $_SESSION['login'];
        return $data;
    }

    public function saveFile($files) {

        $target = '/jivoplayer.ru/www/public/media/'.$files['file']['name'];
        move_uploaded_file( $files['file']['tmp_name'], $target);
        return $target;
    }

    public function change()
    {
        return false;
    }

    public function fetchTasks()
    {
        $post = json_decode(file_get_contents("php://input"), true);
        $data = [];
        $count = $this->taskModel->countAll();
        $count = isset($count) ? $count/3 : '';
        $data['pages'] = $count;
        $data['tasks']= $this->taskModel->getTasks($post['currPage'], $post['order']);
        return $data;
    }
}
