<?php
use App\Router;

$router = new Router();

$router->add_route('/', 'App\Controller\TaskController', 'main', 'main');
$router->add_route('/fetchTasks', 'App\Controller\TaskController', 'fetchTasks');
$router->add_route('/add', 'App\Controller\TaskController','add');
$router->add_route('/change', 'App\Controller\TaskController','change');
$router->add_route('/edit', 'App\Controller\TaskController','edit');
$router->add_route('/delete', 'App\Controller\TaskController','delete');
$router->add_route('/getLink', 'App\Controller\TaskController','getLink');
$router->add_route('/getFile', 'App\Controller\TaskController','getFile');
//
$router->add_route('/login', 'App\Controller\UserController', 'main', 'login');
$router->add_route('/logIn', 'App\Controller\UserController', 'login');
$router->add_route('/logout', 'App\Controller\UserController','logout');
$router->execute();
