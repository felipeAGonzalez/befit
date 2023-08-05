<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetOtherController extends Controller
{
    // Mostrar el formulario de reseteo de contraseña
    public function showResetForm(Request $request)
    {
        return view('auth.reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    // Procesar la solicitud de reseteo de contraseña
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('home')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
