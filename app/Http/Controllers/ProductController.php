<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\Service;
use App\Models\SubsidiaryProduct;
use App\Models\Subsidiary;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $subsidiaryProducts = SubsidiaryProduct::where('subsidiary_id', Auth::user()->subsidiary_id)->paginate(10);
        return view('products.index', compact('subsidiaryProducts'));
    }

    public function create()
    {
        $subsidiary = Subsidiary::all();
        $categories = Category::all();

        return view('products.form', compact('categories','subsidiary'));
    }

    public function store(Request $request)
    {
        $services = Service::where('key',$request->input('key'))->first();
        if ($services) {
            $error = ValidationException::withMessages(['Error' => 'La clave elegida se encuentra utilizada como un servicio']);
            throw $error;
        }
        $product = Product::where('key',$request->input('key'))->first();
        if (! $product) {
            $product = new Product();
            $product->key = $request->input('key');
            $product->name = $request->input('name');
            $product->category_id = $request->input('category');
            $product->save();
        }

        $subsidiaryProduct = new SubsidiaryProduct();
        $subsidiaryProduct->product_id = $product->id;
        $subsidiaryProduct->subsidiary_id = $request->input('subsidiary_id');
        $subsidiaryProduct->unit_price = $request->input('unit_price');
        $subsidiaryProduct->sell_price = $request->input('sell_price');
        $subsidiaryProduct->amount = $request->input('amount');
        $subsidiaryProduct->save();

        return redirect()->route('products.index')->with('success', 'Producto dado de alta exitosamente');
    }

    public function show($id)
    {
        $subsidiaryProduct = SubsidiaryProduct::where('product_id',$id)->first();
        return view('products.show', compact('subsidiaryProduct'));
    }
    public function edit($id)
    {
        $subsidiary = Subsidiary::all();
        $categories = Category::all();
        $subsidiaryProduct = SubsidiaryProduct::where('product_id', $id)->first();
        $product = Product::findOrFail($id);
        return view('products.form', compact('subsidiaryProduct','categories','subsidiary'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->key = $request->input('key');
        $product->name = $request->input('name');
        $product->category_id = $request->input('category');
        $product->save();

        $product = SubsidiaryProduct::where('product_id',$id);
        $subsidiaryProduct->product_id = $product->id;
        $subsidiaryProduct->subsidiary_id = $request->input('subsidiary_id');
        $subsidiaryProduct->unit_price = $request->input('unit_price');
        $subsidiaryProduct->sell_price = $request->input('sell_price');
        $subsidiaryProduct->amount = $request->input('amount');
        $subsidiaryProduct->save();

        return redirect()->route('products.show', $product->id)->with('success', 'Producto actualizado exitosamente');
    }
    public function destroy($id)
    {
        $product = SubsidiaryProduct::where('product_id',$id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
    }
    public function showAdd($id)
    {
        $subsidiaryProduct = SubsidiaryProduct::where(['product_id' => $id,'subsidiary_id' => Auth::user()->subsidiary_id])->first();

        return view('products.addShow', compact('subsidiaryProduct'));
    }
    public function add(Request $request,$id)
    {
        $subsidiaryProduct = SubsidiaryProduct::where(['product_id' => $id,'subsidiary_id' => Auth::user()->subsidiary_id])->first();

        $amount = $request->input('amount');
        if ($subsidiaryProduct->amount > $amount) {
            $error = ValidationException::withMessages(['Error' => 'La cantidad ingresada no puede ser menor a la actual']);
            throw $error;
        }
        $subsidiaryProduct->amount = $amount;
        $subsidiaryProduct->save();
        return view('products.show',compact('subsidiaryProduct'))->with('success', 'Inventario del producto actualizado');
    }
}
