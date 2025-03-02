<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Session;
class EmailController extends Controller
{
    public function sendWelcomeEmail(Request $request){
        $data = Session::get('appointment_data');
        $toEmail=$data['email'];
        $message = $data['name']. "You are welcome";
        $subject= 'Appointment';
        $goal="The goal of the appointment: " . $data['doctor'];
        Mail::to($toEmail)->send(new WelcomeEmail($message, $subject, $goal));
        Session::forget('appointment_data');
    }
}