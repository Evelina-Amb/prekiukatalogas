<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\City;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'company.city']);

if ($request->filled('cities')) {
    $query->whereHas('company', function ($q) use ($request) {
        $q->whereIn('city_id', $request->cities);
    });
}


        if ($request->filled('quantity_min')) {
            $query->where('quantity', '>=', $request->quantity_min);
        }

        if ($request->filled('quantity_max')) {
            $query->where('quantity', '<=', $request->quantity_max);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('categories') && !in_array(null, $request->categories)) {
    $query->whereIn('category_id', $request->categories);
}

        $products = $query->get();

        return view('katalogas', [
            'products' => $products,
            'cities' => City::all(),
            'categories' => Category::all(),
        ]);
    }
}
