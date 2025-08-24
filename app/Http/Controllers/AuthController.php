<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\PostRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(AuthenticationRequest $request)
    {

        $credentials = $request->validated();
       
       if(Auth::attempt($credentials)) {
          $request->session()->regenerate();
        Alert::success( Auth::user()->role .', ' . Auth::user()->name , 'Selamat datang kembali!');
        return redirect('/dashboard');
        // return redirect()->route('dashboard.index'); // Adjust this route as necessary
       }

        toast('Username atau Password Salah', 'error');
        return redirect()->back(); // Adjust this route as necessary

    }

    public function register()
    {
        return view('auth.register');
    }


    public function registerPost(PostRegisterRequest $request)
    {
        $request->validated();

       if (User::create($request->all())) {
            $request->session()->regenerate();
            
        toast('Berhasil Membuat Akun!', 'success');
        return redirect()->route('login');
        }
        
        toast('Gagal Membuat Akun!', 'error');
        return redirect()->back();

    }

    public function logout(Request $request, $id) {
       $users = User::findOrFail($id);

       Auth::logout($users);

         $request->session()->invalidate();

         toast('Logout Berhasil', 'success')->timerProgressBar();
         return redirect()->route('login'); // Adjust this route as necessary

    }
}
