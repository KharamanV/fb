<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Mail\ConfirmRegistration;

use App\Models\User;
use App\Models\UserActivation;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Validator;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/post';

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
            'login' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // TODO: make roles properties for this class, and put property in 'role_id' instead of role_id directly
        return User::create([
            'login'     => $data['login'],
            'email'     => $data['email'],
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'password'  => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $this->sendActivationMail($user);

        return back()->with('status', 'На ваш email адрес было отправлено письмо с ссылкой для подтверждения регистрации');
        //$this->guard()->login();
        //return redirect($this->redirectPath());
    }

    /**
     * Sending a email with confirmation registration link
     * 
     * @param $user User, who need to send a email with link
     * @return void
     */
    public function sendActivationMail($user)
    {
        $userActivation = new UserActivation();

        if ($user->is_active || !$userActivation->shouldSend($user->id)) {
            return;
        }

        $token = $userActivation->createActivation($user->id);
        $link = route('register.activate', $token);

        Mail::to($user)->send(new ConfirmRegistration($link));        
    }

    public function resendActivationEmail(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            
        }
    }

    /**
     * Checking the token match and
     * activates the user and signing in him into site
     * 
     * @param $token Token for the matching
     * @return \Illuminate\Http\Response
     */
    public function activate($token)
    {
        $userActivation = new UserActivation();

        if ($user = $userActivation->activateUser($token)) {
            Auth::login($user);
            return redirect($this->redirectPath());
        }
        return response('Страница не найдена', 404);
    }
}
