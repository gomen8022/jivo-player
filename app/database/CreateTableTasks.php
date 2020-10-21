<?php

namespace App\Migration;

use App\Migration;
use App\DataBase;

class CreateTableTasks extends Migration {

  public function __construct(DataBase $db) {
    parent::__construct($db);
    $this->up();
  }

  function up()
  {
    $sql = 'CREATE TABLE  IF NOT EXISTS tasks (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name TEXT NOT NULL,
file LONGTEXT NOT NULL,
link LONGTEXT NOT NULL,
uniq INT DEFAULT 0 ,
often INTEGER DEFAULT 0,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)';
    $this->createDatabase($sql);
  }

}
