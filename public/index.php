<?php
require '../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
list($host,$resource,$id,$action) = explode( '/', $uri);

$requestMethod = $_SERVER["REQUEST_METHOD"];
$dataFile = '/var/tmp/tasks.txt';

if (! file_exists($dataFile)) {
    file_put_contents($dataFile, serialize([]));
}

if ($resource == 'task' && $requestMethod == 'POST') {
    $tasks = unserialize(file_get_contents($dataFile));
    $currentId = count($tasks);
    $input = (array) json_decode(file_get_contents('php://input'), true);
    $newResource = ['id' => $currentId+1, 'description' => $input['description'] ?? '', 'is_completed' => false];

    $tasks[] = $newResource;
    file_put_contents($dataFile, serialize($tasks));

    header('HTTP/1.1 201 CREATED');
    echo json_encode($newResource);
}

if ($resource == 'tasks' && $requestMethod == 'GET') {
    $tasks = unserialize(file_get_contents($dataFile));

    header('HTTP/1.1 200 OK');
    echo json_encode($tasks);
}

if ($resource == 'task' && $requestMethod == 'PATCH' && !is_null($id) && $action == 'complete') {
    $tasks = unserialize(file_get_contents($dataFile));
    $tasks[$id-1]['is_completed'] = true;
    file_put_contents($dataFile, serialize($tasks));

    header('HTTP/1.1 204 NO CONTENT');
}