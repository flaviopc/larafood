<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Error get all products.
     *
     * @return void
     */
    public function testErrorGetAllProducts()
    {
        $tenant = 'value';
        $response = $this->getJson("/api/v1/products?token_company={$tenant}");

        $response->assertStatus(422);
    }

    /**
     * Get all products by tenant
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        $tenant = factory(Tenant::class)->create();
        $response = $this->getJson("/api/v1/products?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

     /**
     * Error Get product by identify.
     *
     * @return void
     */
    public function testErrorGetProductByIdentify()
    {
        $tenant = factory(Tenant::class)->create();
        $product = 'value';
        $response = $this->getJson("/api/v1/products/{$product}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get product by identify.
     *
     * @return void
     */
    public function testGetProductByIdentify()
    {
        $tenant = factory(Tenant::class)->create();
        $product = factory(Product::class)->create();
        $response = $this->getJson("/api/v1/products/{$product->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
