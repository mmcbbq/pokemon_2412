<?php
include '../config/loader.php';
$request = explode('/', $_SERVER['REQUEST_URI']);

$entity = $request[1] ?? null;
$methoed = $request[2] ?? null;
$id = $request[3] ?? null;

switch ($methoed) {
    case '':
        echo 'Welcome';
        break;
    case 'create':
        require_once '../src/pokemon/create.php';
        break;
    case 'index';
        require_once '../src/pokemon/read.php';
        break;
    case 'show';
        require_once '../src/pokemon/show.php';
        break;
    case 'update';
        require_once '../src/pokemon/update.php';
        break;
    case 'delete';
        require_once '../src/pokemon/delete.php';
        break;
    default:
        echo 404;
}
