<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product; // Make sure to import the Product model

class HomeController extends Controller
{
    public function index()
    {
        // Ensure the 'home' view exists
        return view('home', [
            'banners' => Banner::all(),
            'categories' => Category::all(),
            'products' => Product::with('categories')->get(),
        ]);
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id); // Fetch the category or fail
        return view('category', compact('category'));
    }

    public function showProduct($id)
    {
        $product = Product::with('categories')->findOrFail($id); // Fetch the product with its categories
        return view('product_detail', compact('product')); // Return the view with the product details
    }
}

