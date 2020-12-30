<?php

namespace App\Http\Controllers;

use App\Models\WebContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(){
        if (auth()->user()){
            if (auth()->user()->admin > 0){
                return view('adminDashboard');
            }
            else{
                return back();
            }
        }
        else{
            return back();
        }
    }
    public function salir(){
        if (auth()->user()){
            Auth::logout();
            return redirect()->intended('/web-admin');
        }
    }
}
