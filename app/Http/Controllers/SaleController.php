<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Service;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.create');
    }
    public function search(Request $request)
    {
        $search = $request->all();
        $element = Product::where('key', $search)->get();
        if ($element->isEmpty()) {
            $element = Service::where('key',$search)->get();
        }
        return response()->json($element);
    }
    public function store(Request $request)
    {

        \Log::info($request->all()['elementsSold']);

        // Aquí puedes validar y guardar la venta en la base de datos
        // $venta = new Sale();
        // $venta->cliente = $request->input('cliente');
        // $venta->producto = $request->input('producto');
        // ...
        // $venta->save();

        // return redirect()->route('sale.index')->with('success', 'Venta registrada exitosamente.');
    }
}

