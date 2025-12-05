<!DOCTYPE html>
<html>
<head>"
    <title> Search results for "{{ $query }}"</title>
</head>

@if($results->isEmpty())
    <p>No products found.</p>
@else
    <ul>
        @foreach($results as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
@endif

<a href="{{ route('products.index') }}">Back to Products</a>