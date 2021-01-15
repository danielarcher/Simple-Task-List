<?php
/** @var App $app */

use App\TaskComplete;
use App\TaskCreate;
use App\TaskList;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('ok');
    return $response;
});

$app->get('/tasks', TaskList::class);
$app->post('/task', TaskCreate::class);
$app->patch('/task/{id}/complete', TaskComplete::class);
