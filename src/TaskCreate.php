<?php

namespace App;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskCreate
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function __invoke(Request $request, Response $response)
    {
        $description = $request->getParsedBody()['description'] ?? '';

        /**
         * Insert new resource
         */
        $sql = "INSERT INTO task SET description=:desc, is_completed=false;";
        $this->conn->prepare($sql)->execute(['desc' => $description]);

        /**
         * Fetch last recent resource added
         */
        $result = $this->conn->query('select * from task where id = '.$this->conn->lastInsertId())->fetch();

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}