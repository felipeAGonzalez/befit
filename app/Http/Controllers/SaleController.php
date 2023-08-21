<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\ClientDate;
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
        $sellElements = collect(json_decode($request->all()['elementsSold'],true));

        $filtered = $sellElements->whereNotNull("clientKey")->first();
        $total=$sellElements->sum('subtotal');
        $sale =Sale::create([
            'client_id'=> $filtered ? $filtered['clientKey'] : null,
            'sale_date'=>now(),
            'total'=>$total
        ]);
        foreach ($sellElements as $key => $value) {
            $saleDetail=[
                'sale_id'=>$sale->id,
                'amount'=>$value['qty'],
                'category'=>$value['category'],
                'price'=>$value['subtotal'],
            ];
            $value['clientKey'] ? $saleDetail['service_id'] = $value['id'] :  $saleDetail['product_id']=$value['id'];
            $value['clientKey'] ? $saleDetail['description'] = 'Venta de servicio' :  $saleDetail['description']='Venta de producto';
            SaleDetail::create($saleDetail);
            $product=Product::where(['id'=>$value['id']])->first();
            if ($product) {
                $product->amount -= $value['qty'];
                $product->save();
            }
        }
        $service = Service::where(['id'=>$filtered['id']])->first();
        $clientDate = ClientDate::where(['client_id'=>$filtered['clientKey']])->first();
        $date = now();
        $endDate = $date->addDays($service->days)->format('Y-m-d');
        $clientDate->start_date=$date;
        $clientDate->end_date=$endDate;
        $clientDate->save();
        return redirect()->route('sales.index')->with('success', 'Venta registrada exitosamente.');
    }
}

