<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all products sorted by name
        $products = Product::getAllProductsSortedByName();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function view($id)
    {
        $products = Product::getProduct($id);

        // Pass the products to the view
        return view('products.view', compact('products'));
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => true]);
        // return redirect()->route('products.index')
        //     ->with('success', 'Task deleted successfully');
    }

    public function edit($id)
    {
        $products = Product::getProduct($id)->first();

        // Pass the products to the view
        return view('products.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'required|string',
            'publish' => 'required|boolean'
        ]);

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('name');
        $product->product_price = $request->input('price');
        $product->product_desc = $request->input('desc');
        $product->publish = $request->input('publish');
        $product->save();

        return response()->json(['success' => true]);
    }
}
