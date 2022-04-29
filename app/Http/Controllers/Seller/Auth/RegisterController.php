<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;

use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Session;

class RegisterController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::SELLER;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:seller');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('seller.dashboard', [
            'title' => 'Seller Register',
            'loginRoute' => 'seller.register',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // $this->validator($request->all())->validate();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sellers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],          
        ]);

        event(new Registered($seller = $this->create($request->all())));

        // $this->guard()->login($seller);
        if(Auth::guard('seller')->attempt(['email' => $request->email,'password' => $request->password])) {
            //set user session  
            $request->session()->regenerate();          
            Session::put('id', $this->guard()->user()->id);
            Session::put('email', $this->guard()->user()->email);
            $session_id = $request->session()->get('session_id');
            if(empty($session_id)) {
                $session_id = session_create_id(Str::random(256));
                Session::put('id', $this->guard()->user()->id);
                Session::put('email', $this->guard()->user()->email);
                // $session_id = Str::random(256);
                session()->put('session_id', $session_id);
                return response()->json([
                    'seller' => $this->guard()->user(),
                    'session' => $session_id
                ], 200);
            }             
        }

        if ($response = $this->registered($request, $seller)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:seller',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new staff instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Staff
     */
    protected function create(array $data)
    {
        return Seller::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('seller');
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
        //
    }    
}
