<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Image;
use Session;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use ElfSundae\Laravel\Hashid\Facades\Hashid;


class UserController extends Controller
{   
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }     

    /*
    |--------------------------------------------------------------------------
    | User Controller login method
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */ 
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function getAuthorizedUser()
    {
        if (Auth::check()) {
            // $userData = Auth::user();
            return response()->JSON([
                // 'id' => Session::get('id'),
                // 'email' => Session::get('email'),
                // 'userName' => Auth::user()->name,
                'authUser' => Auth::user(),
                // 'session'  => Session::get('session_id')
            ], 200);
        }
    }     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CheckCurrentPassword(Request $request)
    { 
        //
        if(Auth::check()) {
            $current_password = $request->current_password;
            $id = Auth::user()->id;

            // $user = User::findOrFail($id);

            $Checkpassword = User::where('id', $id)->first();

            if(Hash::check($current_password, $Checkpassword->password )) {
                return response()->json([
                    'success' => 'Pasword match'
                ], 200);
            } else {
                return response()->json([
                    'msg' => 'Password not match'
                ], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        // $uid =    Hashid::decode($id);
        //
        if (Auth::check()) {
            $user = User::where('id', $id)->first();
           
            $oldPassword = $request->validate([ 'current_password' => 'required' ]);

            if($oldPassword) {
                if(Hash::check($request->current_password, $user->password)) {
                    $isValid = $request->validate([                           
                                'new_password' => 'required|string|min:8',           
                            ]);
                    if ($request->new_password != $request->password_confirmation) {
                        return response()->json([ 'password_confirmation' => 'The new password confirmation does not match.' ], 500);
                    } else {
                        $user->password = Hash::make($request->new_password);
                        $user->save();
                    }        
    
                } else {
                    return response()->json([ 'current_password' => "Current Password  does not match." ], 500);
                }
            }
           
        }
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
        // $uid =    Hashid::decode($id);
        //
        if(Auth::check()) {
            // $id = Auth::user()->id;

            $user = User::findOrFail($id);  

            $this->validateUser();
            /**
             * Format product_image and Update at product_image
             * public folder and remove old image from folder
             */ 
            if($request->image != $user->image) {
                $strpos = strpos($request->image, ';');
                $sub = substr($request->image, 0, $strpos);
                $exe = explode('/', $sub) [1];
                $avatar = time().".".$exe;
                $img = Image::make($request->image)->resize(200, 200);

                $upload_path = public_path()."/users_avatar/"; 
                $image = $upload_path.$user->image;

                $img->save($upload_path.$avatar); 

                if(file_exists($image)) {
                    @unlink($image);
                }

            } else {
                $avatar = $user->image; 
            }

            // $shipcountry = Country::where('id', $request->country_id)->first();
            // $shipstate = State::where('id', $request->state_id)->first();
            // $shipcity = City::where('id', $request->city_id)->first();            

            /**
             * Save Form User Dateils into database Users table
             */
            $user->address = $request->address;
            // $country = Country::where('id', $request->country_id)->first();
            $user->country_id = $request->country_id;
            // $state   = State::where('id', $request->state_id)->first();
            $user->state_id   = $request->state_id;
            // $city    = City::where('id', $request->city_id)->first();
            $user->city_id   = $request->city_id;
            $user->pincode = $request->pincode;
            $user->phone   = $request->phone;
            $user->image   = $avatar;

            // return $user;
            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        // $uid =    Hashid::decode($id);
        if(Auth::check()) {
            // $id = Auth::user()->id;

            $user = User::findOrFail($id);

            //
            $image_path  = public_path()."/users_avatar/";
            $image = $image_path.$user->image;
            if(file_exists($image)) {
                @unlink($image);
            }
            $user->delete();            
        }
    }
    
    /**
     * 
     */
    protected function validateUser() {
        return request()->validate([
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'image' => 'required',
            'pincode' => 'required',
            'phone' => 'required',

        ]);
    }    

}
