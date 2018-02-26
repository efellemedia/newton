<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'can.register']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        
        return Validator::make($data, $rules);
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if ($this->notUsingRegistrationDomain($request->get('email'))) {
            return redirect('/register')
                ->withInput()
                ->with([
                    'flash' => [
                        'level'   => 'danger',
                        'message' => 'Please use a valid domain to register with.'
                    ]
                ]);
        }
        
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $token = str_limit(md5($data['email'].str_random()), 25, '');
        
        return User::create([
            'name'               => $data['name'],
            'email'              => $data['email'],
            'password'           => bcrypt($data['password']),
            'confirmation_token' => $token
        ]);
    }
    
    protected function notUsingRegistrationDomain($email)
    {
        $userDomain   = strstr($email, '@');
        $configDomain = config('newton.registration.domain');
        
        if ($configDomain and ($userDomain !== '@'.$configDomain)) {
            return true;
        }
        
        return false;
    }
}
