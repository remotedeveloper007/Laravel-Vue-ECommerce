<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Listeners\LogVerifiedUser;
use Illuminate\Http\RedirectResponse;
use App\Models\User;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, RedirectsUsers;

    /**
     * Where to redirect users after verification.
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
        // $this->middleware('auth:api');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * 
     */
    public function show()
    {
        # code...
        return redirect(env('FRONT_URL') . '/email/verify');

        /**
         * Taken from stackoverflow/questions/56678908/how-to-add-conditions-in-laravel-auth
         */
        // $user = Auth::user();
        // if (is_null($user->email_verified_at)) {
        //     return view('auth.verify');
        // }elseif (is_null($user->phone_verified_at)) {
        //     return redirect("phone_verify");
        // }else{
        //      return redirect($this->redirectPath());
        // }        

    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request): RedirectResponse
    {
        // dd($request->all());exit();
        $user = User::findOrFail($request->route('id'));

        // $request->fulfill();

        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        
        
        if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            // return $request->wantsJson()
            //             ? new JsonResponse([], 204)
            //             : redirect($this->redirectPath());

            return redirect(env('FRONT_URL') . '/email/verify/already-verified');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            User::where(['id' => $user->id])->update(['is_verified' => 1]);
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 204)
        //             : redirect($this->redirectPath())->with('verified', true);

        return redirect(env('FRONT_URL') . '/email/verify/success');
    }

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request)
    {
        //
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }    
}
