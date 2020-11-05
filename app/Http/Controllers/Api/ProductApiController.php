<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantformRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantformRequest $request)
    {
        $products = $this->productService->getProductsByTenantUuid(
            $request->token_company,
            $request->get('categories',[])
        );

        return ProductResource::collection($products);
    }

    public function show(TenantformRequest $request, $flag)
    {
        if(!$product = $this->productService->getProductByFlag($flag)){
            return response()->json(['message'=>'Product not found'],404);
        }

        return new ProductResource($product);
    }
}
