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

    public function update(Product $product, ProductRequest $request)
    {
        $product->update($request->validated());

        return redirect()->route('products.view', ['product' => $product->id])
            ->with('success', 'Product updated successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
}
