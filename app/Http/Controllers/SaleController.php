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
        $subsidiary = Subsidiary::all();

        if (Auth::user()->position == 'ROOT' || Auth::user()->position == 'DIRECTIVE') {
            $sales = Sale::query()->orderByDesc('id')->paginate(10);
            return view('sales.index', compact('sales','subsidiary'));
        }
        $sales = Sale::where(['subsidiary_id' => Auth::user()->subsidiary_id])->orderByDesc('id')->paginate(10);
        return view('sales.index', compact('sales','subsidiary'));

    }
    public function searchSale(Request $request)
    {
        $search = $request->all();
        if ($search['subsidiary_id'] != null) {
            $sales = Sale::where(['subsidiary_id' => $search['subsidiary_id']])->orderByDesc('id')->paginate(10);
            $subsidiary = Subsidiary::all();
            return view('sales.index', compact('sales','subsidiary'));
        }
        return redirect()->route('sales.index');

    }
    public function create()
    {
        return view('sales.create');
    }
    public function search(Request $request)
    {
        $search = $request->all();
        $element = Product::where('key', $search)->orWhere('name',$search)->first();
        if ($element) {
            $element = SubsidiaryProduct::where(['subsidiary_id' => Auth::user()->subsidiary_id,'product_id'=>$element->id])->with(SubsidiaryProduct::PRODUCTS)->get();
            return response()->json($element);
        }
        $element = Service::where('key',$search)->get();
        return response()->json($element);
    }

    public function searchClient(Request $request)
    {
        $search = $request->all();
        $client = client::where('id', $search)->with('clientDate')->first();
        return response()->json($client);
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
        if (! $request->all()['payment_type']){
            $error = ValidationException::withMessages(['Error' => 'Debe de elegir un tipo de pago']);
            throw $error;
        }
        $user = Auth::user();
        $filtered = $sellElements->whereNotNull("clientKey")->first();
        $total=$sellElements->sum('subtotal');
        $service=$sellElements->whereIn('category',$categories);
        $totalCard = 0;
        if ($request->all()['payment_type']== 'mixed') {
            if (! $request->all()['mixedInput']) {
                $error = ValidationException::withMessages(['Error' => 'Debe de ingresar la cantidad pagada con la tarjeta']);
                throw $error;
            }
            $totalCard = $request->all()['mixedInput'];
        }

        $clientId = $this->validateSale($service, $filtered, $sellElements);
        DB::beginTransaction();
        $sale =Sale::create([
            'client_id'=> $clientId,
            'sale_date'=>now(),
            'subsidiary_id'=>$user->subsidiary_id,
            'shift'=>$user->shift,
            'payment_type' => $request->all()['payment_type'],
            'total_card' => $totalCard,
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
                        $error = ValidationException::withMessages(['Error' => 'El producto '.$subsidiaryProduct->product->name.' no tiene inventario suficiente']);
                        DB::rollBack();
                        throw $error;
                    }
                $subsidiaryProduct->amount -= $value['qty'];
                $subsidiaryProduct->save();
            }
        }
        if ($filtered) {
            $daysService = null;
            $days = 0;
            $service = Service::where(['id'=>$filtered['id']])->first();
            if ($service->category == 'Paquete Por Visitas') {
                $daysService = $service->days;
            }
            $clientDate = ClientDate::where(['client_id'=>$filtered['clientKey']])->first();
            $date = now();
            if ($clientDate->end_date) {
                $days = date_diff(now(),$clientDate->end_date)->format('%R%a');
            }
            $endDate = ! $clientDate->end_date || $days <= 0 ? $date->addDays($service->days)->format('Y-m-d') : $clientDate->end_date->addDays($service->days)->format('Y-m-d');
            $clientDate->end_date = $endDate;
            $clientDate->days_service = $daysService;
            $clientDate->save();
        }
        DB::commit();
        return redirect()->route('sales.ticket',['id' => $saleId]);
    }

    public function ticket(Request $request, $saleId){
        $sale = Sale::where('id',$saleId)->first();
        $saleDetails=SaleDetail::where('sale_id',$sale->id)->get();
        if ($sale->client_id) {
            $client=Client::where('id',$sale->client_id)->first();
            return view('sales.ticket', compact('sale','saleDetails','client'));
        }

        return view('sales.ticket', compact('sale','saleDetails'));
    }
    public function show(Request $request, $saleId){
        $sale = Sale::where('id',$saleId)->first();
        $saleDetails=SaleDetail::where('sale_id',$sale->id)->get();
        if ($sale->client_id) {
            $client=Client::where('id',$sale->client_id)->first();
            return view('sales.show', compact('sale','saleDetails','client'));
        }

        return view('sales.show', compact('sale','saleDetails'));
    }
}
