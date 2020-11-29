<?php

namespace App\Http\Controllers\Auth;

use App\BlockIp;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo   = RouteServiceProvider::HOME;
    protected $maxAttempts  = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        if (!$this->limiter()){
            BlockIp::updateOrCreate(
                ['ip' => $request->ip()],
                ['ip' => $request->ip(), 'times' => DB::raw('times + 1')]
            );
        }

        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts, $this->decayMinutes
        );
    }

}
