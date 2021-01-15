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
            'description' => mt_rand()
        ];
        $response = $this->client->post('/task',null,json_encode($payload))->send();

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_it_should_create_non_completed_new_task()
    {
        $payload = [
            'description' => mt_rand()
        ];
        $response = $this->client->post('/task',null,json_encode($payload))->send();
        $resource = json_decode($response->getBody(true),true);
        $this->assertFalse((bool) $resource['is_completed']);
    }

    public function test_it_should_list_tasks_after_creation()
    {
        /**
         * Create a new task
         */
        $payload = [
            'description' => mt_rand()
        ];
        $this->client->post('/task', ['Content-Type' => 'application/json'],json_encode($payload))->send();

        /**
         * Retrieve task list
         */
        $response = $this->client->get('/tasks')->send();

        /**
         * Assert list is not empty
         */
        $list = json_decode($response->getBody(true),true);
        $this->assertNotEmpty($list);

        /**
         * Assert the new resource is part of the list
         */
        $lastResourceAdded = array_pop($list);
        $this->assertEquals($payload['description'], $lastResourceAdded['description']);
    }

    public function test_it_should_complete_a_task_and_change_status_to_completed()
    {
        /**
         * Create a new task
         */
        $payload = [
            'description' => mt_rand()
        ];
        $response = $this->client->post('/task', ['Content-Type' => 'application/json'],json_encode($payload))->send();
        $createdResource = json_decode($response->getBody(true),true);

        /**
         * Change to completed
         */
        $this->client->patch('/task/'.$createdResource['id'].'/complete')->send();

        /**
         * Retrieve task list
         */
        $response = $this->client->get('/tasks')->send();

        $list = json_decode($response->getBody(true),true);
        $this->assertNotEmpty($list);
        $this->assertTrue((bool) $list[$createdResource['id']-1]['is_completed']);
    }
}