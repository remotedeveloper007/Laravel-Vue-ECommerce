<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
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
            
        }

        //if unsucessful, then redirect back to login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'));         
    }
    /*
    |--------------------------------------------------------------------------
    | User Controller login method
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */ 

    protected function register(Request $request) {
        //Validate register form data
        $this->validate($request, [
            'name' => ['required', 'string','min:6', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 
        
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        
        //Attempt to log admin in        
        if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            //set user session
            Session::put('userSession');
            //if successful, then redirect to thieir intended location
        }

        //if unsucessful, then redirect back to login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'));         
    }    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function myProfile()
    {
        $userData = Auth::user();; 
        return response()->JSON([
            'authUser' => $userData
        ], 200);
    }     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
