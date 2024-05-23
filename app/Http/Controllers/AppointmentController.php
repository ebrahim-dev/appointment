<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');
        $doctor = $request->input('doctor');

        $appointmentExists = Appointment::where('date', $date)
                                        ->where('time', $time)
                                        ->where('doctor', $doctor)
                                        ->exists();

        return response()->json(['available' => !$appointmentExists]);
    }
}