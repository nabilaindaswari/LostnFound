<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register
    // show
    public function showRegister()
    {
        return view('auth.register');
    }
    // function
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:2',
            // nim harus sesuai (diawali dengan huruf diikuti dengan angka)
            'nim' => ['required','size:11','regex:/^[A-Za-z][0-9]{10}$/','unique:users,nim'],
            // email harus student (diawali dengan huruf diikuti dengan angka, dan menggunakan @student.untan.ac.id)
            'email' => ['required','email','regex:/^[A-Za-z][0-9]{10}@student\.untan\.ac\.id$/i','unique:users,email'], 
            'phone' => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,11}$/', 'unique:users,phone'],
            // role harusnya tetap user, kalo melalui form register

            // password minimal 8 karakter, harus 1 angka, 1 kapital, dll standar aturan password
            'password' => ['required', 'min:8', 'regex:/[a-zA-Z]/', 'regex:/[0-9]/', 'regex:/[^a-zA-Z0-9]/', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'nim' => $data['nim'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Registrasi berhasil');
    }

    // login
    // show
    public function showLogin()
    {
        return view('auth.login');
    }
    // func
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session() -> regenerate();
            // return kemana sebagi cadangan redirect
            return redirect()->intended(route('home'));
        }

        // kalo salah, return kemana?
        return back()->withErrors([
            'email' => 'Email tidak valid atau tidak terdaftar!',
            'password' => 'Password tidak valid.'
        ])->onlyInput('email');
        //onlyInput = input emailnya di ingat meksipun balik ke laman login
    }

    // logout
    // func
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil');

    }
}