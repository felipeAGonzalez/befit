<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

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
        // Validación de datos aquí

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Cliente dado de alta exitosamente');
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.form', compact('client'));
    }

    public function update(Request $request, $id)
    {
        // Validación de datos aquí

        $client = Client::findOrFail($id);
        $client->update($request->all());
        return redirect()->route('clients.show', $client->id)->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
