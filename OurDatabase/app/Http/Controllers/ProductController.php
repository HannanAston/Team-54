<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {


    //show all products
    public function index(){ 
        
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    
    //show specific product
    public function show(Product $product){ 
    
        return view('products.show', compact('product'));
    }

//search function
    public function search(Request $request){

        $query = $request->input('query');

        $results = Product::where('name', 'like', "%{query}%")
                            ->orWhere('description', 'like', "%{query]%")->get();

        return view('products.search', compact('results', 'query'));
    }
}