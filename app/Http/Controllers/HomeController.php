<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{

    public function redirect()
    {
        if (Auth::id())
        {
            if(Auth::user()-> usertype == '0')
            {
                return redirect()->route('index');
            }
            else
            {
                return view('admin.home');
            }
        }   
        else
        {
            return redirect()-back();
        }
    }


    public function index()
    {
        $doctor=Doctor::all();
        return view('user.home',compact('doctor'));
    }





}