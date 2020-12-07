<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * Test Error create Evaluation
     *
     * @return void
     */
    public function testErrorCreateEvaluation()
    {
        $order = 'value';

        $response = $this->postJson("api/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }

    /**
     * Test Error create Evaluation
     *
     * @return void
     */
    public function testCreateEvaluation()
    {
        $client = \factory(Client::class)->create();

        $token = $client->createToken(\Str::random(10))->plainTextToken;

        $order = $client->orders()->save(\factory(Order::class)->make());

        $payload = [
            'stars' => 4,
            'comment' => 'comentario positivo'
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson("api/auth/v1/orders/{$order->identify}/evaluations", $payload, $headers);

        $response->assertStatus(201);
    }
}
