<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientDate;
use Throwable;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.form');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'last_name_two' => 'string|max:255',
                'email' => 'nullable|email',
                'birth_date' => 'date',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'date_entry' => 'required|date',
            ]);
            $client=Client::create($request->all());
            ClientDate::create(['client_id'=>$client->id,'date_entry'=>$request->all()['date_entry']]);
            return redirect()->route('clients.index')->with('success', 'Cliente dado de alta exitosamente');
        } catch (Throwable $th) {
            switch ($th->getCode()) {
                case 23000:
                        return redirect()->back()->withInput()->withErrors(['message' => 'Usuario Duplicado']);
                    break;
                default:
                        return $this->response($th);
                    break;
            }
        }
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        $clientDate = ClientDate::where('client_id',$id)->first();
        return view('clients.show', compact('client','clientDate'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $clientDate = ClientDate::where('client_id',$id)->first();
        return view('clients.form', compact('client','clientDate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'last_name_two' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_entry' => 'nullable|date',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());
        if ($request->date_entry) {
            $clientDate = ClientDate::where('client_id',$id)->first();
            $clientDate->update(['date_entry'=>$request->date_entry]);
        }
        return redirect()->route('clients.show', $client->id)->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente');
    }
}