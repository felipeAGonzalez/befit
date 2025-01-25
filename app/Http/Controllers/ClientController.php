<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientDate;
use App\Utils;
use Throwable;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(10);
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
                'last_name_two' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'phone_number' => 'required|numeric|digits:10',
                'birth_date' => 'nullable|date',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
                'date_entry' => 'required|date',
            ]);
            $client=$request->all();
            $client['photo'] = Utils::saveImage($request->file('photo'));
            $client['subsidiary_id'] = Auth::user()->subsidiary_id;
            $client=Client::create($client);
            ClientDate::create(['client_id'=>$client->id,'date_entry'=>$request->all()['date_entry']]);
            return redirect()->route('clients.index')->with('success', 'Cliente dado de alta exitosamente');
        } catch (Throwable $th) {
            switch ($th->getCode()) {
                case 23000:
                        return redirect()->back()->withInput()->withErrors(['message' => 'Usuario Duplicado']);
                    break;
                default:
                        return redirect()->back()->withInput()->withErrors(__($th->getMessage()));
                    break;
            }
        }
    }
    public function search(Request $request){
        $search = $request->query('search');
        $clients = Client::query();

        if ($search ?? false) {
            $clients = Client::where('id',$search)->orWhere('name','LIKE','%'.$search.'%')->orWhere('last_name','LIKE','%'.$search.'%')->orWhere('last_name_two','LIKE','%'.$search.'%');
        }
        $clients = $clients->paginate(10);
        if (! $clients) {
            $error = ValidationException::withMessages(['Error' => 'Cliente no encontrado']);
            throw $error;
        }
        return view('clients.index', compact('clients'));
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'date_entry' => 'nullable|date',
        ]);
        $query=$request->all();
        $client = Client::findOrFail($id);

        if ($request->hasFile('photo')) {
            Utils::deleteImage($client->photo);
            $query['photo'] = Utils::saveImage($request->file('photo'));
        }
        $client->update($query);
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
        Utils::deleteImage($client->photo);
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente');
    }
    public function showPhoto($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.photo', compact('client'));
    }
    public function photo(Request $request,$id)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
        ]);
        $query=$request->all();
        $client = Client::findOrFail($id);
        if ($request->hasFile('photo')) {
            Utils::deleteImage($client->photo);
            $query['photo'] = Utils::saveImage($request->file('photo'));
        }
        $client->update($query);

        return redirect()->route('clients.show',$client->id)->with('success', 'Cliente actualizado exitosamente');
    }
}
