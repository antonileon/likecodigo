<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function username()
    {
        $loginData = request()->input('login');
        $fieldName = filter_var($loginData, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldName => $loginData]);
        return $fieldName;
    }*/

    protected function credentials(\Illuminate\Http\Request $request)
    {
        return ['email' => $request->email, 'password' => $request->password,'status'=>'Activo'];
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {

        if ( !User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($request->email, 'email'))
                ->withErrors([
                    'email' => 'El usuario no es correcto',
                ]);
        }

        if ( !User::where('email', $request->email)->where('status','Activo')->first() ) {
            return redirect()->back()
                ->withInput($request->only($request->email, 'email'))
                ->withErrors([
                    'email' => 'Usuario desactivado, contacte con el equipo de soporte.',
                ]);
        }

        if ( !User::where([['email', $request->email],['password', bcrypt($request->password)]])->first() ) {
            return redirect()->back()
                ->withInput($request->only($request->email, 'email'))
                ->withErrors([
                    'email' => 'Error de autentificación',
                ]);
        }



    }
}
