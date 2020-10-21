<?php

namespace App\Model;

use App\DataBase;
use App\ModelBase;

class TaskModel extends ModelBase {

    public function __construct(DataBase $db) {
        parent::__construct($db);
    }

    public function put($name, $file, $link, $often, $unique) {
        $database = $this->db;
        $result = $this->db->query("INSERT INTO tasks (name, file, link, often, uniq, reg_date) VALUES ('{$name}', '{$link}','{$file}','{$often}', '{$unique}', NOW())");
        return $result;
    }

    public function getTasks($currPage, $order) {
        $code = $this->db->query("SELECT * FROM tasks ORDER BY $order ASC");
        if($code->num_rows) {
            return $code->fetch_all(MYSQLI_ASSOC);
        }

        return '';
    }
    public function edit($id, $name, $file, $link, $often, $unique) {
        $database = $this->db;
        $this->db->query( "UPDATE tasks SET name='$name',
                                          file='$file',
                                          link='$link',
                                          often=$often,
                                          uniq=$unique
                                          WHERE id=$id");
    }
    public function delete($id) {
        $database = $this->db;
        $result = $this->db->query("DELETE FROM `tasks` WHERE id = $id");
    }

    public function countAll() {
        $count = $this->db->query("SELECT COUNT(id) FROM tasks");
        return $count->lengths;
    }
}
