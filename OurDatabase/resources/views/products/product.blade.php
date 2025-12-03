<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
@foreach($products as $product)
    <p>{ {product->name }}</p>
@endforeach