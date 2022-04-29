<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use Session;
use App\Models\Sms;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;
use  Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('index',[
            'title' => 'register',
            'loginRoute' => 'register',
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
        $this->validator($request->all())->validate();        

        event(new Registered($user = $this->create($request->all())));
        
        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            // Send Register SMS
            // $message = "Dear ". $request->name . " you have successfully registered in Wiseman Trendz online shopping portal. 
            //            Please ckeck your email to activate your account and login. Thanks"; 
            // $mobile = $request->mobile;
            // Sms::sendSms($message, $mobile);

            // Send Register Email
            // $email = $request->email;
            // $messageData = ['name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile];
            // Mail::send('email.register', $messageData, function($message) use($email) {
            //     $message->to($email)->subject("Dear ". $request->name . " you have successfully registered in 
            //                                   Wiseman Trendz online shopping portal.");
            // });
            
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect(env('FRONT_URL') . '/email/verify');
        // return redirect();
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'mobile' => ['required', 'number', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $time = now();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            // 'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            // 'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        // $user->sendEmailVerificationNotification();

        return $user;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
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
