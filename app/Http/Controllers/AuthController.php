<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input berdasarkan spesifikasi field layar [cite: 259]
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Proses autentikasi (QUE-01) 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role [cite: 252]
            return Auth::user()->role === 'admin' 
                ? redirect()->intended('/admin/dashboard') 
                : redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Kredensial tidak cocok.']);
    }
}