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
use App\Services\AfribaPayService;

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
                    "otp_code"=>$request->otp_code ?? null,
                    "operator"=>$request->channel,
                    "phone_number"=>$request->phone_payment,
                    "amount"=>env('PRICE') * $request->quantity,
                    "order_id"=>$order->id,
                    "reference_id"=>'K-2.0-'.time()
                ];

                $data = OrderController::payment($data);
                
                if(isset($data['data']['status']) && $data['data']['status']=='PENDING'){
                    return response()->json(['success' => ["message" => __('messages.payment_order'),'url' => $data['data']['provider_link'] ?? null,"order_id"=>$data['data']['order_id']]], 200);
                }else{
                    $order->delete();
                    return response()->json(['error' => ["error" => [__('messages.error_order')]]], 401);
                }

            }

            return response()->json(['success' => ["message" => __('messages.success_order')]], 200);

        } else {
            return response()->json(['error' => ["error" => [__('messages.error_order')]]], 401);
        }
    }

    public function status($id){
        return response()->json(['success' => ["order" => Order::find($id)]], 200);
    }

    public function price($quantity){
        return response()->json(
            ['success' => 
                [
                    "amount" => number_format($quantity * env('PRICE'), 0, '.', ' ').' '.env('DEVISE'),
                    "quantity"=>$quantity.' Kg',
                    "price"=>number_format(env('PRICE'), 0, '.', ' ').' '.env('DEVISE')
                ]
            ], 200);
    }

    public function get()
    {
        return response()->json(['success' => ["data" => auth()->user()->orders()->with('type_package')->orderBy('created_at', 'desc')->get()]], 200);
    }

    public function call_back(Request $request)
    {
        $order = Order::find($request->order_id);

        if($order){

            if($request->status=='SUCCESS' && $order->state == 'En Attente'){

                $order->state = 'Paiement effectué';
                $order->save();

            }elseif($request->status=='FAILED' && $order->state == 'En Attente'){

                $order->state = 'Paiement réfusé';
                $order->save();

            }
        }

        return redirect()->away('karite://');
    }

    public static function payment($data){

        $afribaPayService = new AfribaPayService;

        if(is_null($data['otp_code'])){
            
            $response = $afribaPayService->initiatePayIn(
                $data['operator'],
                'CI',
                $data['phone_number'],
                $data['amount'],
                'XOF',
                $data['order_id'],
                $data['reference_id'],
                'fr',
                route('call-back'),
                route('call-back'),
                route('call-back'),
            );
            
        }else{

            $response = $afribaPayService->confirmPayInWithOTP(
                $data['operator'],
                $data['otp_code'],
                'CI',
                $data['phone_number'],
                $data['amount'],
                'XOF',
                $data['order_id'],
                $data['reference_id'],
                'fr',
                route('call-back'),
                route('call-back'),
                route('call-back')
            );
        }
        
        return $response;
    }
}
