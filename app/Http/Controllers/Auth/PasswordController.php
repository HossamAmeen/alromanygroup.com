<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use View;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected  $redirectTo = "admin";

    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return redirect('admin')->with('status', trans($response));
    }


    public function get_email(){
        $pageTitle = "استعادة كلمة المرور";
        return View::make('admin.account.login',compact('pageTitle'));
    }


    public function get_reset($token){
        $pageTitle = "استعادة كلمة المرور";
        return View::make('admin.account.reset',compact('pageTitle','token'));
    }

}
