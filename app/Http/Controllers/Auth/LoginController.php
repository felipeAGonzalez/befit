<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            return view('welcome');
        }

        return redirect()->back()->withInput()->withErrors(['message' => 'Credenciales inválidas']);
    }
    public function welcome()
    {
        return view('welcome');
    }
   protected function authenticated(Request $request, $user)
    {
        dd("ho");

        return redirect()->route('welcome');
    }


}
