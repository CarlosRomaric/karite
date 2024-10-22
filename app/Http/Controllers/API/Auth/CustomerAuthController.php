<?php

namespace App\Http\Controllers\API\Auth;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class CustomerAuthController extends Controller
{
    public function login(Request $request){

        if($request->lang=='Français')
            App::setLocale('fr');
        else
            App::setLocale('en');

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {

            $tokenResult = $customer->createToken('Customer Personal Access Token');
    
            $success['access_token'] = $tokenResult->accessToken; 
            $success['token_type'] = 'Bearer';
            $success['expires_at'] = Carbon::now()->addWeeks(1)->toDateTimeString();
            $success['customer'] = collect($customer)->except(['created_at', 'updated_at']);
            $success['message'] = __('messages.login');
    
            return response()->json(['success' => $success], 200);

        } else {
            return response()->json(['error' => ["error"=>[__('messages.error_login')]]], 401);
        }
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
    }

    public function sign_in(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'lang' => 'required',
        ]);

        if($request->lang=='Français')
            App::setLocale('fr');
        else
            App::setLocale('en');

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $customer = Customer::where('phone', $request->phone)->where('state','SUCCESS')->first();
        
        if ($customer) {
            return response()->json(['error' => ["phone_exists"=>[__('messages.phone_exists')]]], 401);
        }

        $customer = Customer::where('email', $request->email)->where('state','SUCCESS')->first();
        
        if ($customer) {
            return response()->json(['error' => ["email_exists"=>[__('messages.email_exists')]]], 401);
        }

        $customer = new Customer;
        $customer->password = bcrypt($request->password);
        $customer->phone = $request->phone;
        $customer->firstname = $request->first_name;
        $customer->lastname = $request->last_name;
        $customer->email = $request->email;
        $customer->hash = $this->hashed();
        $customer->state = 'SUCCESS';
        $customer->save();

        $tokenResult = $customer->createToken('Customer Personal Access Token');
    
        $success['access_token'] = $tokenResult->accessToken; 
        $success['token_type'] = 'Bearer';
        $success['expires_at'] = Carbon::now()->addWeeks(1)->toDateTimeString();
        $success['customer'] = $customer;
        $success['message'] = __('messages.sign_in');
        
        return response()->json(["success"=>$success]);
    }


    public static function hashed() {
        $hash = '';
        for ($i = 0; $i < 4; $i++) {
            $hash .= rand(0, 9);
        }
        return $hash;
    }
}
