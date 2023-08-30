<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Subsidiary;
use App\Models\SaleDetail;
use App\Models\ClientDate;
use App\Models\SubsidiaryProduct;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::where(['subsidiary_id' => Auth::user()->subsidiary_id])->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.create');
    }
    public function search(Request $request)
    {
        $search = $request->all();
        $element = Product::where('key', $search)->first();
        if ($element) {
            $element = SubsidiaryProduct::where(['subsidiary_id' => Auth::user()->subsidiary_id,'product_id'=>$element->id])->with(SubsidiaryProduct::PRODUCTS)->get();
            return response()->json($element);
        }
        $element = Service::where('key',$search)->get();
        return response()->json($element);
    }

    private function validateClient($object){
        if ($object) {
            $client = Client::where('id',$object['clientKey'])->first();
            if (! isset($client)) {
                $error = ValidationException::withMessages(['Error' => 'No se encontró información del cliente, Verifique']);
                throw $error;
            }
            return $client->id;
        }
        return null;
    }

    private function validateSale($service, $object, $sellElements){
        if ($sellElements->isEmpty()) {
            $error = ValidationException::withMessages(['Error' => 'La venta no tiene ningún elemento']);
            throw $error;
        }
        $service = $service->first();
        if ($service) {
            if (! $service['clientKey']) {
                $error = ValidationException::withMessages(['Error' => 'Para vender un servicio es necesario asignar un cliente']);
                throw $error;
            }
        }
        return $this->validateClient($object);

    }

    public function store(Request $request)
    {
        $categories = $this->categories;
        $sellElements = collect(json_decode($request->all()['elementsSold'],true));
        $user = Auth::user();
        $filtered = $sellElements->whereNotNull("clientKey")->first();
        $total=$sellElements->sum('subtotal');
        $service=$sellElements->whereIn('category',$categories);

        $clientId = $this->validateSale($service, $filtered, $sellElements);
        DB::beginTransaction();
        $sale =Sale::create([
            'client_id'=> $clientId,
            'sale_date'=>now(),
            'subsidiary_id'=>$user->subsidiary_id,
            'shift'=>$user->shift,
            'total'=>$total
        ]);
        $saleId=$sale->id;
        foreach ($sellElements as $key => $value) {
            $saleDetail=[
                'sale_id'=>$saleId,
                'amount'=>$value['qty'],
                'category'=>$value['category'],
                'price'=>$value['subtotal'],
            ];
            $value['clientKey'] ? $saleDetail['service_id'] = $value['id'] :  $saleDetail['product_id']=$value['id'];
            $value['clientKey'] ? $saleDetail['description'] = 'Venta de servicio' :  $saleDetail['description']='Venta de producto';
            SaleDetail::create($saleDetail);
            $subsidiaryProduct = SubsidiaryProduct::where(['subsidiary_id' => Auth::user()->subsidiary_id,'product_id'=>$value['id']])->first();
            if ($subsidiaryProduct) {
                    if ($subsidiaryProduct->amount < $value['qty']) {
                        $error = ValidationException::withMessages(['Error' => 'El producto '.$product['name'].' no tiene inventario suficiente']);
                        DB::rollBack();
                        throw $error;
                    }
                $subsidiaryProduct->amount -= $value['qty'];
                $subsidiaryProduct->save();
            }
        }
        if ($filtered) {
            $service = Service::where(['id'=>$filtered['id']])->first();
            $clientDate = ClientDate::where(['client_id'=>$filtered['clientKey']])->first();
            $date = now();
            if (! $clientDate->end_date) {
                $endDate = $date->addDays($service->days)->format('Y-m-d');
                $clientDate->start_date=$date;
                $clientDate->end_date=$endDate;
                $clientDate->save();
            }
                $endDate = $clientDate->end_date->addDays($service->days)->format('Y-m-d');
                $clientDate->start_date=$date;
                $clientDate->end_date=$endDate;
                $clientDate->save();
        }
        DB::commit();
        return redirect()->route('sales.ticket',['id' => $saleId]);
    }

    public function ticket(Request $request, $saleId){
        $user = Auth::user();
        $subsidiary = Subsidiary::where('id',$user->subsidiary_id)->first();
        $sale = Sale::where('id',$saleId)->first();
        $saleDetails=SaleDetail::where('sale_id',$sale->id)->get();
        if ($sale->client_id) {
            $client=Client::where('id',$sale->client_id)->first();
            return view('sales.ticket', compact('sale','saleDetails','subsidiary','client'));
        }

        return view('sales.ticket', compact('sale','saleDetails','subsidiary'));
    }
}
