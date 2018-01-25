<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        $userObj = new User();
        $user = $userObj->findByCredentials($request->email, $request->password);
        // Get user record
        $user = User::where('mobile_no', $request->get('mobile_no'))->first();

        // Check Condition Mobile No. Found or Not
        if($request->get('mobile_no') != $user->mobile_no) {
            \Session::put('errors', 'Your mobile number not match in our system..!!');
            return back();
        }        
        
        // Set Auth Details
        \Auth::login($user);
        
        // Redirect home page
        return redirect()->route('home');
    }    
}
