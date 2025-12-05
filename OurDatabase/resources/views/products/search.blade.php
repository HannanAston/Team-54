
@php
    if($results->isEmpty()) {
        $products = $products ?? collect();
    } else {
        $products = $results;
    }

@endphp

@include('products.index', ['products' => $products, 'query' => $query])
