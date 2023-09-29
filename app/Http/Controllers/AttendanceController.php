<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Validation\ValidationException;
use App\Models\ClientDate;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $client=[];
        return view('attendance.index',compact('client'));
    }

    public function search(Request $request){
        $search = $request->query('search');

        $client = Client::query();

        if ($search ?? false) {
            $client = Client::where('id',$search);
        }
        $client = $client->first();
        if (! $client) {
            $error = ValidationException::withMessages(['Error' => 'Cliente no encontrado']);
            throw $error;
        }
        if (! $client->clientDate->end_date) {
            $error = ValidationException::withMessages(['Error' => 'Al cliente '.$client->name.' con clave '.$client->id.' aun no se le ha vendido un servicio']);
            throw $error;
        }
        $days = date_diff(now(),$client->clientDate->end_date)->format('%R%a');
        if ($days <= 0) {
            $error = ValidationException::withMessages(['Error' => 'Servicio vencido. El cliente debe de renovar']);
            throw $error;
        }
        return view('attendance.index', compact('client'));

    }

    public function registerAttendant(Request $request, $id){

        $clientDate = ClientDate::where('client_id',$id)->first();
        $days = date_diff(now(),$clientDate->end_date)->format('%R%a');

        if ($clientDate->days_service) {
            $clientDate->days_service = $clientDate->days_service - 1;
            $clientDate->save();
        }
        if ($clientDate->days_service == 0 && $clientDate->days_service != null) {
            $error = ValidationException::withMessages(['Error' => 'Visitas terminadas']);
            throw $error;
        }
        if ($days < 2) {
            \Session::flash('message', 'Esta por vencer su periodo');
        }

       $client=[];
        return view('attendance.index',compact('client'));
    }
}
