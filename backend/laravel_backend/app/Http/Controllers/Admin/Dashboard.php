<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Controller
{
    public function main()
    {
        if(Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif(Auth::check() && Auth::user()->role === 'librarian') {
            return redirect()->route('librarian.dashboard');
        } else {
            return redirect()->route('login.show');
        }
    }
    public function index()
    {
        return view('admin.dashboard');
    }
        public function index2()
    {
        return view('librarian.dashboard');
    }
}
