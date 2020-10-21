<?php

namespace App;

abstract class ModelBase
{

    public $session;
    protected $db;

    public function __construct(DataBase $db) {
        $this->db = $db;
    }

}
