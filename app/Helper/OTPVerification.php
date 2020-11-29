<?php
namespace App\Helper;

use App\Mail\CustomMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
class OTPVerification
{
    use VerifiesEmails;

    static public function verifyEmail($code)
    {
        $user = User::where('id', auth()->user()->id)->where('verify_code', $code)->first();

        if(!$user) {
            return false;
        }

        $user->email_verified_at = Carbon::now()->timestamp;
        $user->save();
        return true;
    }

    static public function sendOTPEmail($user){
        $email                      = $user->email;
        $verify_code                = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
        $body                       = "Hi, <br> Your OTP Code is: " . $verify_code;
        User::find($user->id)->update([
            'verify_code'       => $verify_code,
            'verify_code_time'  => Carbon::now()->addMinutes(2),
        ]);
        $data                       = ['body' => $body, 'subject' => 'Verify Your Email'];
        \Mail::to($email)->send(new CustomMail($data));
        return true;
    }

    static public function resend()
    {
        self::sendOTPEmail(auth()->user());
    }
}
