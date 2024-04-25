<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        // Assuming product has categories, you might want to show them too
        $categories = $product->categories; // This will work if you have set up a belongsToMany relation in the Product model

        return view('product_detail', compact('product', 'categories'));
    }
}
