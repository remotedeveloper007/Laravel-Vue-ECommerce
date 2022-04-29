<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
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
            $tokenData = $user->createToken('userToken', ['place-orders', 'check-status'])->accessToken;

            //set user session
            $session_id = Str::random(64);
            session()->put('session_id', $session_id);
            //if successful, then retur response json data
            return response()->json([
                'user'         => $user,
                'access_token' => $tokenData,  
                'session'      => Session::get('session_id'),
                'status_code'  => 200
            ], 200);
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
    public function login(Request $request)
    {
        $request->validate([
            // 'name' => ['required', 'string','min:6', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'remember_me' => 'boolean'           
        ]);        
        //
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
               'message' => 'Invalid Credientials!',
               'status_code' => 401
            ], 401);
        }

        $user = $request->user();

        if ($user) {
            $tokenData = $user->createToken('User Token', ['place-orders', 'check-status'])->accessToken;
            
            //set user session
            $session_id = Str::random(64);
            session()->put('session_id', $session_id);            
        }

        $token = $tokenData->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        if ($token->save()) {
            
            return response()->json([
                'user'         => $user,
                'access_token' => $tokenData->accessToken,                
                'token_type'   => 'Bearer',
                'token_scope'  => $tokenData->token->scope[0],
                'expires_at'   => Carbon::parse($tokenData->token->expires_at)->toDateTimeString(),
                'session'      => Session::get('session_id'),
                'status_code'  => 200
            ], 200);
        } else {
            return response()->json([
                'status_code' => 500
            ], 500);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
