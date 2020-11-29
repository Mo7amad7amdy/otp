<?php

namespace App\Http\Controllers;

use App\Helper\OTPVerification;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.otp');
    }

    public function send(Request $request){

        $request->validate([
            'verify_code' => 'required|min:6'
        ]);

        $otp = OTPVerification::verifyEmail($request->verify_code);

        if ($otp == false)
            return back()->withErrors(['This Code is not Correct']);
        auth()->logout();
        return redirect('login');
    }

    public function resend(){
        OTPVerification::resend();
        return back();
    }
}
