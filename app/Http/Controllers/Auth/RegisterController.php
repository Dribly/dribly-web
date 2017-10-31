<?php

namespace App\Http\Controllers\Auth;

use Dribly\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
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

    use RegistersUsers;

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
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:2|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

//        $request = new \GuzzleHttp\Psr7\Request('POST', $_ENV['SERVICE_USERS'].'/api/v1/register',[
        $request = new \GuzzleHttp\Psr7\Request('POST', 'http://dribly:3008/'.'/ping',[
    'form_params' => ['firstname' => $data['firstname'],
            'lastÏword' => bcrypt($data['password'])
        ]
    ]);
        $client = new \GuzzleHttp\Client(['cookies' => true]);
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();die();
});
$promise->wait();
//'firstname' => $data['firstname'],
//            'lastname' => $data['lastname'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
        ECHO "RES WAS " . (int)$res ."\n";
die('done');
        return $res;
    }
    

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
       echo "HI";die(); //
    }    
    
    
}
