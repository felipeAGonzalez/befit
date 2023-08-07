<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    private $categories=[
        "--Seleccione una opción --",
        "Anual",
        "Semestral",
        "Mensual",
        "Semanal",
        "Visita",
        "Paquete Por Visitas"
    ];
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('services.form',compact('categories'));
    }

    public function store(Request $request)
    {
        $service = new Service([
            'key' => $request->input('key'),
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'days' => $request->input('days'),
            'price' => $request->input('price'),
        ]);

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service creado exitosamente.');
    }

    public function edit($id)
    {
        $categories = $this->categories;
        $service = Service::find($id);
        return view('services.form', compact('service','categories'));
    }

    public function update(Request $request, $id)
    {

        $service = Service::find($id);
        $service->key = $request->input('key');
        $service->name = $request->input('name');
        $service->category = $request->input('category');
        $service->days = $request->input('days');
        $service->price = $request->input('price');
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service eliminado exitosamente.');
    }


}
