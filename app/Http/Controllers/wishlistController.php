<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    // Show wishlist page
    public function index()
    {
        $wishlists = [];
        if (auth('customer')->check()) {
            $wishlists = Wishlist::with('product')
                ->where('customer_id', auth('customer')->user()->id)
                ->get();
        }
        return view('frontend.wishlist', compact('wishlists'));
    }

    // Add to wishlist (safe: avoid duplicates)
    public function addToWishlist(Request $request)
    {
        $product_id = $request->product_id;
        $customer_id = auth('customer')->id();

        // Avoid duplicates
        Wishlist::updateOrCreate([
            'customer_id' => $customer_id,
            'product_id' => $product_id
        ]);

        return back()->with('success', 'Added to wishlist!');
    }

    // Remove from wishlist
    public function removeFromWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $customerId = auth('customer')->user()->id;

        Wishlist::where('product_id', $request->product_id)
            ->where('customer_id', $customerId)
            ->delete();

        return back()->with('success', 'Product removed from wishlist');
    }
}
