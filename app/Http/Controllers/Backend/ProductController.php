<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    function index()
    {
        return view('backend.products.productIndex');
    }
    function create()
    {
        $categories = Category::where('status', true)->latest()->get();
        return view('backend.products.create', compact('categories'));
    }

    function store(Request $request)
    {

        // $request->validate();
        $featuredImage = null;
        $gallaryimg = [];

        if ($request->hasFile('featured_img')) {
            $featuredImage = $request->featured_img->store('products', 'public');
        }

        if (count($request->gallery_imgs) > 0) {
            foreach ($request->gallery_imgs as $gallaryimage) {
                $gallaryimgName = $gallaryimage->store('products', 'public');
                $gallaryimg[] = $gallaryimgName;
            }
        }
        Product::create([
            "category_id" => $request->category,
            "title" => $request->title,
            "slug" => str()->slug($request->title),
            "price" => $request->price,
            "selling_price" => $request->selling_price,
            "brand" => $request->brand,
            "sku" => $request->sku,
            "featured_img" => $featuredImage,
            "gallary_img" => json_encode($gallaryimg),
            "short_details" => $request->short_details,
            "features" => $request->features,
        ]);


        return back()->with('msg', [
            'res' => 'Product has been Added!'
        ]);
    }
}
