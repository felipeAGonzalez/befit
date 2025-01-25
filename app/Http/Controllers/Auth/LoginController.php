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
    public function password(){
        $user=Auth::user();
        return view('auth.password',compact('user'));
    }
    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->need_change) {
                return redirect()->route('password.view');
            }
            return redirect()->route('welcome');
        }

        return redirect()->back()->withInput()->withErrors(['message' => 'Credenciales inválidas']);
    }


    public function welcome()
    {
        return view('welcome');
    }
   protected function authenticated(Request $request, $user)
    {

        return redirect()->route('welcome');
    }


}
