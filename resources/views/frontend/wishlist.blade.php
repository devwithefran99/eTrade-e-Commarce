
@extends('layouts.frontend')
@section('title', 'wishlist')
@section('frontend')


        <!-- Start Wishlist Area  -->
        <div class="axil-wishlist-area axil-section-gap">
            <div class="container">
                <div class="product-table-heading">
                    <h4 class="title">My Wish List on eTrade</h4>
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-wishlist-table">
                        <thead>
                            <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                       <tbody>
@foreach($wishlists['data'] as $item)
    @if($item->product)
        <tr>
            <td>{{ $item->product->title }}</td>

            <td>
                <img src="{{ asset('storage/' . ($item->product->featured_img ?? 'default.png')) }}" width="60">
            </td>

            <td>
                BDT {{ $item->product->selling_price ?? $item->product->price }}/-
            </td>

            <td>
                <a href="{{ route('frontend.product.veiw', $item->product->slug) }}"
                   class="btn btn-primary btn-sm">
                    View
                </a>

                <form action="{{ route('frontend.removeFromWishlist') }}" method="POST" style="display:inline-block;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                    <button class="btn btn-danger btn-sm">Remove</button>
                </form>
            </td>
        </tr>
    @endif
@endforeach
</tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- End Wishlist Area  -->
        @endsection   