<?php

namespace App;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskComplete
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function __invoke(Request $request, Response $response, array $args = [])
    {
        $id =  (int) ($args['id'] ?? 0);

        $sql = "UPDATE task SET is_completed = true WHERE id = :id;";
        $this->conn->prepare($sql)->execute(['id' => $id]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}