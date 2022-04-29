<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

session_start();

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string','min:6', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],           
        ]);
        //
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        //Attempt to log admin in        
        if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            //create user accessToken
            $tokenData = Auth::user()->createToken('userToken');

            //set user session  
            $request->session()->regenerate();          
            Session::put('id', Auth::user()->id);
            Session::put('email', Auth::user()->email);
            $session_id = $request->session()->get('session_id');
            if(empty($session_id)) {
                $session_id = session_create_id(Str::random(256));
                // $session_id = Str::random(256);
                session()->put('session_id', $session_id);
            }  
            
            if(!empty($session_id)) {
                // update cart if user has any item in cart
                DB::table('cart')->where(['session_id' => $session_id])->update(['user_id' => Auth::user()->id, 'user_email' => Auth::user()->email]);
            }            
            
            //if successful, then retur response json data
            $token = $tokenData->token;
           
            if ($token->save()) {
                return response()->json([
                    // 'id'         => Session::get('id'),
                    'email' =>  Session::get('email'),
                    'token'    => $tokenData->accessToken,
                    // 'Authorization'   => 'Bearer '.$tokenData->accessToken,
                    // 'session'         => $session_id,
                ], 200);
            }

        } else {
            return response()->json([               
                'message' => 'Invalid Credientials!',
                'status_code' => 500
            ], 500);
        }

    }

    /**
     * Autinticate User Login
     *
     * @return \Illuminate\Http\Response
     */
    protected function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'remember_me' => 'boolean'           
        ]);        
        //
        if( !Auth::attempt($credentials) ) {
            return response()->json([
               'message' => 'Invalid login Credientials!',
               'status_code' => 401
            ], 401);
        }

         //Create Token
         $userToken = Auth::user()->createToken('authToken');    
         
         //set user session
         $request->session()->regenerate();          
         Session::put('id', Auth::user()->id);
         Session::put('email', Auth::user()->email);
         $session_id = $request->session()->get('session_id');
         if(empty($session_id)) {
            $session_id = session_create_id(Str::random(256));
            session()->put('session_id', $session_id);
         }
        //  Session::put('session_id', $session_id);
         
        if(!empty($session_id)) {
            // update cart if user has any item in cart
            DB::table('cart')->where(['session_id' => $session_id])->update(['user_id' => Auth::user()->id, 'user_email' => Auth::user()->email]);
        }

         $token = $userToken->token;

         if ($request->remember_me) 
         {
            $token->expires_at = Carbon::now()->addWeeks(1);
         }
        // $token->save();
        if ($token->save()) {
            return response()->json([
                // 'id'         => Session::get('id'),
                'email' =>  Session::get('email'),
                'token' => $userToken->accessToken,
                // 'Authorization'   => 'Bearer '.$userToken->accessToken,
                'expires_at'   => Carbon::parse($userToken->token->expires_at)->toDateTimeString(),
                // 'session'      => $session_id
            ], 200);
        } 
        else {
            return response()->json([
                'status_code' => 500
            ], 500);            
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // $request->user()->token()->revoke();

        $token = $request->user()->token();
        $token->revoke();

        $request->session()->invalidate();

        $request->session()->forget('id');
        $request->session()->forget('email');
        $request->session()->forget('session_id');

        // \Cookie::queue(\Cookie::forget('session_id'));
        // \Session::flush();        

        return response()->json([
            'message'     => 'User has been successfully logged out!',
            'status_code' => 200
        ], 200);
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
