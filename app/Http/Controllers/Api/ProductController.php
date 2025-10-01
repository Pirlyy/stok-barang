<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'supplier' => 'required|string|max:225',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Not Found'], 404);

        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Not Found'], 404);

        $product->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
