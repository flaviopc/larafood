<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $tenant = \auth()->user()->tenant;

        $users = User::where('tenant_id',$tenant->id)->count();
        $tables = Table::count();
        $products = Product::count();
        $categories = Category::count();


        $dados = [
            'totalUsers'=>$users,
            'totalTables'=>$tables,
            'totalProducts' => $products,
            'totalCat' => $categories
        ];

        return view('admin.pages.home.home',$dados);
    }
}
