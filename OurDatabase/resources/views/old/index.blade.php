<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
</head>

@if($products->isEmpty())
    <p>No products available.</p>
@else
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">{{$product->name }}</a>
                </li>
            @endforeach
    </ul>
@endif