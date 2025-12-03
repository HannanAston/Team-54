<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<p>{{$product->description }}</p>
<p>Price: £{{number_format($product->price, 2) }}</p>
<p>Stock: {{$product->stock_qty }}</p>

<a href="{{ route('products') }}">Back</a>
