<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantformRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;

class TableApiController extends Controller
{
    protected $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant(TenantformRequest $request)
    {
        $tables = $this->tableService->getTablesByUuid($request->token_company);
        return TableResource::collection($tables);
    }

    public function show(TenantformRequest $request, $identify)
    {
        if(!$table = $this->tableService->getTableByIdentify($identify)){
            return response()->json(['message'=>'Table not found'],404);
        }

        return new TableResource($table);
    }
}
