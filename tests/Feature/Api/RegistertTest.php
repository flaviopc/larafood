<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistertTest extends TestCase
{
    /**
     * Error create client
     *
     * @return void
     */
    public function testErrorCreateClient()
    {
        $response = $this->postJson('/api/auth/register');

        $response->assertStatus(422);
    }

    /**
     * create client
     *
     * @return void
     */
    public function testCreateClient()
    {
        $payload = [
            'name' => 'Flavio',
            'email' => 'flavio@gmail.com',
            'password' => '123456478'
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
            ->assertExactJson([
                'data'=>[
                    'name' => $payload['name'],
                    'email' => $payload['email']
                ]
            ]);
    }
}
