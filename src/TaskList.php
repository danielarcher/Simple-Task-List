<?php

namespace App;

use http\Message\Body;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskList
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function __invoke(Request $request, Response $response)
    {
        $result = $this->conn->query('select * from task')->fetchAll();

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}