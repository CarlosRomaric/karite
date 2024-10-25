<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use App\Models\Sealed;
use App\Models\TypePackage;
use App\Models\Country;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;


class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function scan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'lang' => 'required',
        ]);

        if($request->lang == 'Français')
            App::setLocale('fr');
        else
            App::setLocale('en');

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $sealed = Sealed::with(['lot.agribusiness.region', 'lot.agribusiness.parc'])
                        ->where('code', $request->qr_code)
                        ->where('state', 'USED')
                        ->first();

        if ($sealed) {

            $verification = Verification::where('code', $request->qr_code)->first();

            if ($verification) {
                $verification->update([
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                ]);
            } else {
                Verification::create([
                    'code' => $request->qr_code,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ]);
            }

            return response()->json(['success' => ["sealed" => $sealed]], 200);
        } else {
            return response()->json(['error' => ["error" => [__('messages.error_qr_code')]]], 401);
        }
    }


    /**
     * Show the form for creating a new resource.
    */


    public function data()
    {
        $customer = auth()->user();

        if ($customer) {
            return response()->json([
                'status' => 'success',
                'data' => $customer,
                'type_package'=> TypePackage::all(),
                'countries'=> Country::all(),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $customer = Customer::findOrfail(auth()->id());

        $file = $request->file('avatar');

        if ($file) {
            $filePath = $file->storeAs('public/avatar', $file->hashName());
            $customer->avatar = $filePath ?? '';
            $customer->avatar = str_replace('public/','',$customer->avatar);
        }

        if($request->password!=''){
            $customer->password = bcrypt($request->password);
        }

        $customer->email = $request->email;
        $customer->firstname = $request->first_name;
        $customer->lastname = $request->last_name;
        $customer->location = $request->location;
        $customer->civility = $request->civility;
        $customer->birthday = $request->birthday;

        if($customer->save()){
            return response()->json(['success' => ["message"=>__('messages.success_update')]], 200);
        }else{
            return response()->json(['error' => ["error"=>[__('messages.error')]]], 401);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
