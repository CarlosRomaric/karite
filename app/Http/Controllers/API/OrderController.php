<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use App\Models\Sealed;
use App\Models\TypePackage;
use App\Models\Country;
use App\Models\Order;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;


class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'quantity' => 'required',
            'address' => 'required',
            'place_delivery' => 'required',
            'type_package_id' => 'required',
            'country_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'lang' => 'required'
        ]);

        if($request->lang == 'Français')
            App::setLocale('fr');
        else
            App::setLocale('en');

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $order = Order::create([
            'customer_id' => auth()->id(),
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity' => $request->quantity,
            'companies' => $request->companies,
            'address' => $request->address,
            'place_delivery' => $request->place_delivery,
            'type_package_id' => $request->type_package_id,
            'country_id' => $request->country_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'state'=>'En Attente'
        ]);
            
        if($order){

            if(trim($request->channel)!=''){

                $data = [
                    'merchantId' => env('PROVIDER'),
                    'amount' => 100,
                    'description' => "Paiement commande",
                    'channel' => $request->channel,
                    'countryCurrencyCode' => "952",
                    'referenceNumber' => $order->id,
                    'customerEmail' => $request->email,
                    'customerFirstName' => $request->firstname,
                    'customerLastname' => $request->lastname,
                    'customerPhoneNumber' => $request->phone,
                    'notificationURL' => route('call-back'),
                    'returnURL' => route('call-back'),
                ];
                
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json; charset=utf-8',
                ])->post('https://www.paiementpro.net/webservice/onlinepayment/init/curl-init.php', $data);
                
                $responseData = json_decode($response->body(), true);
                
                if($responseData['success']){
                    return response()->json(['success' => ["message" => __('messages.payment_order'),'url' => $responseData['url']]], 200);
                }

            }

            return response()->json(['success' => ["message" => __('messages.success_order')]], 200);

        } else {
            return response()->json(['error' => ["error" => [__('messages.error_order')]]], 401);
        }
    }

    public function get()
    {
        return response()->json(['success' => ["data" => auth()->user()->orders()->with('type_package')->get()]], 200);
    }

    public function call_back(Request $request)
    {
        $order = Order::where('id','like',"$request->referenceNumber%")->first();

        if($order){

            if($request->responsecode=='0' && $order->state == 'En Attente'){
                $order->state = 'Paiement effectué';
                $order->save();
            }
        }

        return redirect()->away('karite://');
    }
}
