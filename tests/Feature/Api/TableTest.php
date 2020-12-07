<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error get tables by Tenant.
     *
     * @return void
     */
    public function testGetAllTablesTenantError()
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

    /**
     * Get all tables by Tenant.
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

     /**
     * Error Get table by tenant
     *
     * @return void
     */
    public function testErrorGetTable()
    {
        $table = "value";

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

     /**
     * Get table by tenant
     *
     * @return void
     */
    public function testGetTable()
    {
        $table = factory(Table::class)->create();

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
