<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Appoinment;
use App\Models\Doctor;
use App\Notifications\MyNotification;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
        $data=Appoinment::find($id);
        return view('admin.email_view',compact('data'));
    }
    

    public function sendmail(Request $request,$id)
    {
        $data=Appoinment::find($id);
        $details=[
            'greeting'=>$request->greeting,
            'body'=>$request->body,
            'actiontext'=>$request->actiontext,
            'actionurl'=>$request->actionurl,
            'endpart'=>$request->endpart
        ];
        Notification::send($data,new MyNotification($details));

        return redirect()->back();
    }



        // Mail::to('shuvodewan.sky@gmail.com')->send(new TestMail("hello shuvo"));



}
