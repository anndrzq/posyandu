<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('content.authenticate.login');
    }

    public function authenticate(Request $request)
    {
        $login = $request->validate([
            'username' => 'required|min:4',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($login)) {
            $user = User::findOrFail(Auth::user()->id);
            $request->session()->regenerate();
            $user->last_login = Carbon::now();
            $user->save();
            return redirect()->intended('/dashboard')->with('success', 'Anda Berhasil Masuk');
        }
        return back()->with('LoginFail', 'Periksa Kembali Email Dan Password Anda');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda Berhasil Logout');
    }
}
