<?php

namespace App\Http\Controllers;

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

}
