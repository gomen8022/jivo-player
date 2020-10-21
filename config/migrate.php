<?php
use App\DataBase;
use App\Migration\CreateTableUsers;
use App\Migration\CreateTableTasks;

$db = new DataBase();
new CreateTableUsers($db);
new CreateTableTasks($db);