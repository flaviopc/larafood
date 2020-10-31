<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->middleware(['can:products']);
        $this->product = $product;
        $this->category = $category;
    }

    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);
        if (!$product)
            return redirect()->back();

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', ['categories' => $categories, 'product' => $product]);
    }

    public function products($idCategory)
    {
        $category = $this->category->find($idCategory);
        if (!$category)
            return redirect()->back();

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', ['category' => $category, 'products' => $products]);
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        $product = $this->product->find($idProduct);
        if (!$product)
            return redirect()->back();

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available',
         ['product' => $product, 'categories' => $categories,'filters'=>$filters]);
    }

    public function attachCategoriesProduct($idProduct, Request $request)
    {
        $product = $this->product->find($idProduct);
        if (!$product)
            return redirect()->back();

        if (!$request->categories || count($request->categories) <= 0)
            return redirect()->back()->with('info', 'Marque pelo menos uma permissão');

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoriesProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category)
            return redirect()->back();

        $product->categories()->detach($category);

        return redirect()->back();
    }
}
