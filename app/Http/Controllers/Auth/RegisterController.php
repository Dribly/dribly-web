<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Rules\EmailUnique;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers {
    register as traitRegister;
    
}

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'bail|required|EmailUnique|string|email|max:255',
                'password' => 'required|string|min:2|confirmed',
        ],[ 
		'email.email_unique'=>'That email address is already in use',
            'email'=>'mooo']);
    }
//public function register(Request $request)
//{
//    try
//    {
//    $this->traitRegister($request);
//    }
//    catch (\ValidationException $e)
//    {
//        echo get_class(($e));
//        var_dump($e->getMessage());
//        die(" I am " . __LINE__  . " " . __FILE__);
////        echo __LINE__ . ' ' . __FILE__ . "<br />";
//        return redirect()->back()->withInput()->with('message', $e->getMessage());
//    }
//}
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = new User();

        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        try {
            if ($user->create()) {
                die('user created');
                return $user;
            }
        } catch (\App\Exceptions\DriblyApiModelException $e) {
//            echo "HIII";
//            return $this->showRegistrationForm();
//            \Flash::error('Please check your data are entered correctly below');
//            die('got here');
//            var_dump($e->getMessage());die();
//            return redirect()->back();
//            die('here '.__LINE__.' ' . __FILE__);
            throw $e;
        }
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user) {
        echo "HI " . __FILE__ . " "  . __LINE__."<br />";
        die(); //
    }
}
