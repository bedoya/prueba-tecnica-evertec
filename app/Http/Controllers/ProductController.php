<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(SearchRequest $request)
    {
        $products = Product::all();
        return $products;
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('products.index');
    }
}
