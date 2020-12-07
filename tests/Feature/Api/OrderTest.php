<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Error order
     *
     * @return void
     */
    public function testErrorOrder()
    {
        $response = $this->postJson('/api/v1/orders');

        $response->assertStatus(422)
            ->assertJsonPath('errors.token_company', [
                \trans('validation.required', ['attribute' => 'token company'])
            ])
            ->assertJsonPath('errors.products', [
                \trans('validation.required', ['attribute' => 'products'])
            ]);
    }

    /**
     * new order
     *
     * @return void
     */
    public function testNewOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $products = factory(Product::class, 12)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        foreach ($products as $product) {
            \array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 2
            ]);
        }


        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Total order
     *
     * @return void
     */
    public function testTotalOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $products = factory(Product::class, 12)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 1
            ]);
        }


        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 547.2);
    }

    /**
     * Test Order not found
     *
     * @return void
     */
    public function testOrderNotFound()
    {
        $order = 'value';

        $response = $this->getJson("/api/v1/orders/{$order}");

        $response->assertStatus(404);
    }

    /**
     * Test Get Order
     *
     * @return void
     */
    public function testGetOrder()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    /**
     * Test Create new Total order Auth
     *
     * @return void
     */
    public function testCreateNewOrderAuth()
    {
        $client = factory(Client::class)->create();

        $token = $client->createToken(\Str::random(10))->plainTextToken;

        $tenant = factory(Tenant::class)->create();

        $products = factory(Product::class, 12)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 1
            ]);
        }


        $response = $this->postJson('/api/auth/v1/orders', $payload, [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test Create new Total with table
     *
     * @return void
     */
    public function testCreateNewOrderTable()
    {
        $table = factory(Table::class)->create();

        $tenant = factory(Tenant::class)->create();

        $products = factory(Product::class, 12)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
            'table' => $table->uuid
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 1
            ]);
        }


        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Test Get My orders
     *
     * @return void
     */
    public function testGetMyOrders()
    {
        $client = factory(Client::class)->create();

        $token = $client->createToken(\Str::random(10))->plainTextToken;

        \factory(Order::class, 10)->create(['client_id' => $client->id]);

        $response = $this->getJson('/api/auth/v1/my-orders', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
}
