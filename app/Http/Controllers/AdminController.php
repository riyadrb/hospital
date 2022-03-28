<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctors');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'number'=>'required',
            'room'=>'required',
            'speciality'=>'required',
            'image'=>['required','mimes:jpg,png,jpeg']

            // 'image'=>['required','mimes:png'] ,
            // 'image'=>'required|mimes:image' ,

        ]) ;

        Doctor::create([
            'name'=>$request->name,
            'mobile'=>$request->number,
            'room'=>$request->room,
            'speciality'=>$request->speciality,
            'image'=>$request->image->store('doctors')
        ]);

        return redirect()->back()->with('message','Doctor data added successfully');

    }

    public function show_appointment()
    {

        $data =Appoinment::all();
        return view('admin.showappoint',compact('data'));
    }

    public function approve($id)
    {
       $appoint= Appoinment::find($id);
       $appoint->update ([ 
        'status'=>'Approved'
        ]);


       return redirect()->back();
    }

    public function canceled($id)
    {
        $cancel=Appoinment::find($id);
        $cancel->update ([
            'status'=>'Canceled'
        ]);

        return redirect()->back();

    }

    public function show_doctor()
    {
        $doctor=Doctor::all();

        return view('admin.doctors_list',compact('doctor'));
    }

    public function del_doctor($id)
    {
        $data=Doctor::find($id);
        $data->delete();
        return redirect()->back();

    }

    public function edit($id)
    {
        $doct=Doctor::find($id);
        return view('admin.update_doctor',compact('doct'));

    }

    public function update(Request $request, $id)
    {
        $data =Doctor::find($id);
        $data->update([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'room'=>$request->room,
            'speciality'=>$request->speciality,
            // 'image'=>$request->image->store('doctors')

        ]);

        return redirect()->route('show_doctor');
    }

    public function email($id)
    {
        return view('admin.email_view');
    }

}
