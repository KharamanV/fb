<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\ConfirmRegistration;

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
            'role_id'   => 3,
            'is_active' => 0
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
        $this->create($request->all());

        return back()->with('status', 'На ваш email адрес было отправлено письмо с ссылкой для подтверждения регистрации');
        //$this->guard()->login();
        //return redirect($this->redirectPath());
    }

    public function sendActivationMail($userId)
    {
        $confirmRegister = new ConfirmRegistration();
        if ($user->activated || !$this->shouldSend($userId)) {
            return;
        }

        $token = $this->activationRepo->createActivation($userId);

        $link = route('user.activate', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        
    }
}
