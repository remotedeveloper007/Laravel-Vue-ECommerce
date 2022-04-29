<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;

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
 
    protected function login(Request $request) {
        //Validate login form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);  
        
        //Attempt to log admin in        
        if(Auth::attempt(['email' => $request->email,'password' => $request->password], $request->remember))
        {
            //set user session
            Session::put('userSession');
            //if successful, then redirect to thieir intended location
            return redirect()->intended($this->redirectPath());
        }

        //if unsucessful, then redirect back to login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'));         
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    } 
}
