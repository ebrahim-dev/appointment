<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function addview(){

        return view('admin.add_doctor');
    }
    public function upload(Request $request){
        $doctor= new doctor;
        $image=$request->file;
        $imagename=time().'.'.$image->getClientoriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $doctor->image=$imagename;
        $doctor->name=$request->name;
        $doctor->phone=$request->phone;
        $doctor->speciality=$request->speciality;
        $doctor->room=$request->room;
        $doctor->appointment_duration = $request->duration; // Add appointment duration
        $doctor->save();
        return redirect()->back()->with('message','Doctor Added Successfully!');

    }
    public function edit_appointments($id){
        $data=appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function appointments(){
         $appoint=appointment::all();
        return view('admin.appointments',compact('appoint'));
    }
    public function approved($id){
        $data=appointment::find($id);
        $data->status="Approved!";
        $data->save();

        return redirect()->back();
    }
     public function rewait($id){
        $data=appointment::find($id);
        $data->status="In progress";
        $data->save();

        return redirect()->back();
    }
    public function delete_doctor($id){
        $data=doctor::find($id);
        $data->delete();
        return redirect()->back();

    }
    public function show_doctors(){
        $doctor=doctor::all();
         return view('admin.show_doctors',compact('doctor'));
    }
    public function edit_doctor($id){
        $data=doctor::find($id);
        return view('admin.edit_doctor',compact('data'));
    }
    public function update_doctor(Request $request){
        $doctor= doctor::find($request->id);
        $image=$request->file;
        $imagename=time().'.'.$image->getClientoriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $doctor->image=$imagename;
        $doctor->name=$request->name;
        $doctor->phone=$request->phone;
        $doctor->speciality=$request->speciality;
        $doctor->room=$request->room;
        $doctor->save();
        return redirect()->back()->with('message','Doctor Updated Successfully!');
    }
}