<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    public function redirect(){
        if (Auth::id()) {
             $doctor = doctor::all();
           if (Auth::user()->usertype=='1') {

            return view('admin.home', compact('doctor')
        );

           }
           else {
            return view('user.home', compact('doctor'));
           }
        }

        else{
            return redirect()->back();
        }
    }

    public function index (){
        $doctor = doctor::all();
        return view ('user.home', compact('doctor'));
    }

    public function appointment(Request $request){
        $data= new appointment;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->date=$request->date;
        $data->time=$request->time;
        $data->phone=$request->number;
        $data->message=$request->message;
        $data->doctor=$request->doctor;
        $data->status='In progress';
        if(Auth::id()){
            $data->user_id=Auth::user()->id;
        }

        $data->save();
        Session::put('appointment_data', $data);
        return view('emails.welcome_mail',['data' => $data]);

        // return redirect()->back()->with('message','Appointment Request Successful!');

    }
        public function myappointment(){
            if (Auth::id()) {
                $userid=Auth::user()->id;
                $appoint=appointment::where('user_id',$userid)->get();
                return view('user.my_appointment',compact('appoint'));
            }
            else{
                return redirect()->back();
            }

    }
    public function cancel_appoint($id){
        $data=appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
}