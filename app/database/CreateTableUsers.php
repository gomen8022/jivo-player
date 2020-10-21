<?php
namespace App\Migration;

use App\Migration;
use App\DataBase;

class CreateTableUsers extends Migration {

  public function __construct(DataBase $db) {
    parent::__construct($db);
    $this->up();
  }

  function up()
  {
    $sql = "CREATE TABLE  IF NOT EXISTS users (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(35) NOT NULL,
password VARCHAR(35) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
    $this->createDatabase($sql);
  }
}
