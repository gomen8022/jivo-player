<?php

namespace App;

class Migration {

    protected $db;

    public function __construct(DataBase $db) {
        $this->db = $db;
    }


    public function createDatabase($sqlQuery)
    {
        $doneSql = ($this->db->query($sqlQuery) === TRUE) ? true : false;
        return $doneSql;
    }

}
