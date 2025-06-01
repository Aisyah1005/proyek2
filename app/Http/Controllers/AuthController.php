<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

    use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    } 

public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|in:customer,owner',
    ]);


    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);
    return redirect('/login')->with('success', 'Pendaftaran berhasil, silakan login.');
}

    public function showLoginForm()
    {
        return view('auth.login');
    }
   public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
        $user = Auth::user(); // otomatis tersimpan di session

        if ($user->role === 'customer') {
            return redirect('/dashboard');
        } else {
            return redirect('/products');
        }
    }


        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    

public function logout()
{
    Auth::logout(); // hapus session login
    return redirect('/login');
}
}