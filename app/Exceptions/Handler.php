<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (in_array('admin', $exception->guards())) {
            return $request->expectsJson()
                ? response()->json(['message' => $exception->getMessage()], 401)
                : redirect()->guest(route('admin.login'));
        }

        if (in_array('seller', $exception->guards())) {
            return $request->expectsJson()
                ? response()->json(['message' => $exception->getMessage()], 401)
                : redirect()->guest(route('seller.login'));
        }


        return $request->expectsJson()
                    ? response()->json(['message' => $exception->getMessage()], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login')); 


         /** ======  OR ======== */            
                    
        // if ($request->expectsJson()) {
        //     return response()->json(['message' => $exception->getMessage()], 401);
        // }                    

        // $guard = Arr::get($exception->guards(), 0);

        // switch($guard) {
        //     case 'admin': 
        //         $login = 'admin.login';
        //     break;

        //     case 'seller':
        //         $login = 'seller.login';
        //     break;
            
        //     default:
        //         $login = 'login';
        //     break;    
        // }        

        // return redirect()->guest($exception->redirectTo() ?? route($login));
    }

}
