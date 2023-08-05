<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.form');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->key = $request->input('key');
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->unit_prize = $request->input('unit_prize');
        $product->sell_price = $request->input('sell_price');
        $product->amount = $request->input('amount');
        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto dado de alta exitosamente');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.form', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->key = $request->input('key');
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->unit_prize = $request->input('unit_prize');
        $product->sell_price = $request->input('sell_price');
        $product->amount = $request->input('amount');
        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', 'Producto actualizado exitosamente');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
    }
}
