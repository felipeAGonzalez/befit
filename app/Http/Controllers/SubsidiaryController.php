<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils;
use App\Models\Subsidiary;
use Illuminate\Support\Facades\Validator;

class SubsidiaryController extends Controller
{
    public function index()
    {
        $subsidiaries = Subsidiary::all();
        return view('subsidiaries.index', compact('subsidiaries'));
    }

    public function create()
    {
        return view('subsidiaries.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subsidiaryData = $request->except('_token', 'logo');
        $subsidiaryData['logo'] = Utils::saveImage($request->file('logo'));
        Subsidiary::create($subsidiaryData);

        return redirect()->route('subsidiaries.index')->with('success', 'Sucursal registrada exitosamente.');
    }

    public function edit(Subsidiary $subsidiary)
    {
        return view('subsidiaries.form', compact('subsidiary'));
    }

    public function update(Request $request, Subsidiary $subsidiary)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subsidiaryData = $request->except('_token', '_method', 'logo');
        if ($request->hasFile('logo')) {
            Utils::deleteImage($subsidiary->logo);
            $subsidiaryData['logo'] = Utils::saveImage($request->file('logo'));
        }

        $subsidiary->update($subsidiaryData);

        return redirect()->route('subsidiaries.index')->with('success', 'Sucursal actualizada exitosamente.');
    }

    public function destroy(Subsidiary $subsidiary)
{
    $subsidiary->delete();

    return redirect()->route('subsidiaries.index')->with('success', 'Sucursal eliminada exitosamente.');
}
}
