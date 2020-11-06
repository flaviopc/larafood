<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantformRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTenant(TenantformRequest $request)
    {
        $categories = $this->categoryService->getCategoriesByUuid($request->token_company);
        return CategoryResource::collection($categories);
    }

    public function show(TenantformRequest $request, $identify)
    {
        if(!$category = $this->categoryService->getCategoryByUuid($identify)){
            return response()->json(['message'=>'Category not found'],404);
        }

        return new CategoryResource($category);
    }
}
