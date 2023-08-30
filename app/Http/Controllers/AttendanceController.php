<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; // Asegúrate de importar el modelo adecuado


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // $search = $request->query('search');

        // $client = Client::when($search, function ($query, $search) {
        //     return $query->where('name', 'like', '%' . $search . '%');
        // })->first();
            $client=[];
        return view('attendance.index',compact('client'));
    }

    public function search(Request $request){
        $search = $request->query('search');

        $client = Client::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->first();

        return view('attendance.index', compact('client'));

    }
}
