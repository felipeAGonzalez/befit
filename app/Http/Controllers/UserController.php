<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subsidiary;


class UserController extends Controller
{
    private $position = [
        "DIRECTIVE" => "Directivo",
        "MANAGER" => "Encargado",
        "RECEPTIONIST" => "Recepcionista",
    ];

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $position = $this->position;
        $subsidiary = Subsidiary::all();
        return view('users.form',compact('subsidiary','position'));

    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'subsidiary_id' => 'required',
            'shift' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = User::create($request->all());
        if (! $user) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('users.show', $user->id);
    }

    public function edit($id)
    {
        $position = $this->position;
        $subsidiary = Subsidiary::all();
        $user = User::findOrFail($id);
        return view('users.form', compact('user','subsidiary','position'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable',
            'shift' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);
        $data=$request->all();
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });
        $user = User::findOrFail($id);
        $user->update($data);
        // \Log::info($data);
        // $user->fill($data);
        // $user->save();
        return redirect()->route('users.show', $user->id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
