<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('dashboard.profile.index', compact('user'));
    }


  

     public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $data = $request->only(['name', 'email']);


        User::find(auth()->user()->id)->update($data);

        toast('Profil berhasil diperbarui!', 'success');
        return redirect()->route('profile.show');
    }

      public function edit()
    {
        $user = auth()->user();

        return view('dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        toast('Password berhasil diperbarui!', 'success');
        return redirect()->route('profile.show');
    }
}
