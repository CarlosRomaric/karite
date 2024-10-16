<?php

namespace App\Livewire\Pages;

use App\Models\Offer;
use App\Models\Order;
use App\Models\TypePackage;
use Livewire\Component;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderCreate extends Component
{
    public $offerId;
    public $lastname, $firstname, $email, $phone, $quantity, $type_package_id;


    public function rules()
    {
        return [
            'lastname'=>'required',
            'firstname'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'quantity'=>'required',
            'type_package_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'lastname.required'=>'le nom de famille est obligatoire',
            'firstname.required'=>'les prénoms sont obligatoire',
            'email.required'=>'votre email est obligatoire',
            'email.email'=>'votre email n\'est pas conforme',
            'phone.required'=>'le contact est obligatoire',
            'quantity.required'=>"la quantité est obligatoire",
            'type_package_id.required'=>"le type de package est obligatoire"
        ];
    }

    public function save()
    {
        $this->validate();

        $order = New Order();
        $order->lastname = $this->lastname;
        $order->firstname = $this->firstname;
        $order->email = $this->email;
        $order->phone = $this->phone;
        $order->quantity = $this->quantity;
        $order->type_package_id = $this->type_package_id;
        $order->offer_id = $this->offerId;
        $order->state = 'En Attente';
        $order->save();
        // Envoyer un email de confirmation
        Mail::to($order->email)->send(new OrderConfirmationMail($order));
        $this->resetInput();
        // Émettre un événement Livewire après l'enregistrement réussi
    $this->dispatch('order-saved', ['message' => 'Votre commande a bien été enregistrée.']);
    }

    public function resetInput()
    {
        $this->reset('lastname','firstname','email','phone','quantity','type_package_id');
    }

    public function render()
    {
        $offer = Offer::find($this->offerId);
        $type_packages = TypePackage::all();
        $data = [
            'offer'=>$offer,
            'type_packages'=>$type_packages
        ];
        return view('livewire.pages.order-create')->with($data);
    }
}
