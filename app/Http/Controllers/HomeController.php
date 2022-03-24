<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
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

    public function appointment(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'date'=>'required',
            'doctor'=>'required',
            'number'=>'required',
            'message'=>'required'    
        ]);
        Appoinment::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'date'=>$request->date,
            'doctor'=>$request->doctor,
            'number'=>$request->number,
            'message'=>$request->message,
            'status'=>'In Progress',
            'user_id'=>Auth::user()?Auth::user()->id:null
        ]);
        return redirect()->back()->with('message','Appointment request has been received');
    }


    public function my_appointment()
    {
        if(Auth::id())
        {
            $userid = Auth::user()->id;
            $appoint=Appoinment::where('user_id',$userid)->get();
            return view('user.my_appointment',compact('appoint'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function cancel($id)
    {
        $data=Appoinment::find($id);
        $data->delete();

        return redirect()->back();

    }





}