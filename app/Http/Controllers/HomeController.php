<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', true)->get();
        $products = Product::where('status', true)->latest()->take(8)->get();
        return view('frontend.index', compact('categories', 'products'));
    }

    function veiwProduct(Product $product)
    {
        return view('frontend.singleProduct', compact('product'));
    }

    public function notFound()
    {
        return view('frontend.404');
    }
}
