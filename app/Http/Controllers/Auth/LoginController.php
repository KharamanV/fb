<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/post';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $adminRedirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redeclaring username() method, which will look on login field on login-page, not email
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        //TODO: Optimize this algorytm
        if (property_exists($this, 'redirectTo')) {
            if (Auth::user()->hasAnyRole('Admin')) {
                $this->redirectTo = property_exists($this, 'adminRedirectTo') ? $this->adminRedirectTo : $this->redirectTo;
            }
            return $this->redirectTo;
        }
        return '/home';


    }

}
