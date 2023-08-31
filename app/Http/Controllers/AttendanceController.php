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
            // $error = ValidationException::withMessages(['Error' => 'Esta por vencer su periodo']);
            \Session::flash('message', 'Esta por vencer su periodo');

        }

       $client=[];
        return view('attendance.index',compact('client'));
    }
}
