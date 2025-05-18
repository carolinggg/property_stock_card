<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
        // Redirect logged-in users to the dashboard or any other route
        return redirect()->route('stocks.index');
    }
        return view('login');
    }

    public function login(Request $request)
    {        
    $request->validate([
    'email' => 'required|string|email',
    'password' => 'required|string',
    ]);
    
    $user = DB::table('users')->where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
    Auth::loginUsingId($user->id); 
    return redirect()->route('stocks.index');
    }
    return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}