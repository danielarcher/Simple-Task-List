<?php

namespace App\Test\System;

use Guzzle\Http\Client;
use PHPUnit\Framework\TestCase;

class RestApiTest extends TestCase
{
    /**
     * @var Client
     */
    private Client $client;

    public function setUp(): void
    {
        $this->client = new Client('http://0.0.0.0:80', array(
            'request.options' => array(
                'exceptions' => false,
            )
        ));
    }

    public function test_it_should_create_new_task()
    {
        $payload = [
            'description' => 'my task'
        ];
        $response = $this->client->post('/task',null,json_encode($payload))->send();

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_it_should_list_tasks()
    {
        /**
         * Create a new task
         */
        $payload = [
            'description' => mt_rand()
        ];
        $this->client->post('/task',null,json_encode($payload))->send();

        /**
         * retrieve task list
         */
        $response = $this->client->get('/tasks')->send();

        $list = json_decode($response->getBody(true),true);
        $this->assertNotEmpty($list);
        $this->assertEquals($payload['description'], $list[0]['description']);
    }

    public function test_it_should_complete_a_task_and_change_status_to_completed()
    {
        /**
         * Create a new task
         */
        $payload = [
            'description' => mt_rand()
        ];
        $response = $this->client->post('/task',null,json_encode($payload))->send();
        $createdResource = json_decode($response->getBody(true),true);

        /**
         * Change to completed
         */
        $this->client->patch('/task/'.$createdResource['id'].'/complete')->send();

        /**
         * retrieve task list
         */
        $response = $this->client->get('/tasks')->send();

        $list = json_decode($response->getBody(true),true);
        $this->assertNotEmpty($list);
        $this->assertTrue($list[0]['is_completed']);
    }

    public function tearDown(): void
    {
        unlink('/var/tmp/tasks.txt');
    }
}