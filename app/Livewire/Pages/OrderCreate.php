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
    public $lastname, $firstname, $email, $phone, $quantity, $type_package_id, $lieu_livraison;


    public function rules()
    {
        return [
            'lastname'=>'required',
            'firstname'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'quantity'=>'required',
            'type_package_id'=>'required',
            'lieu_livraison'=>'required'
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
            'type_package_id.required'=>"le type de package est obligatoire",
            'lieu_livraison.required'=>"Le lieu de la livraison du colis est obligatoire"
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
        $order->lieu_livraison = $this->lieu_livraison;
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
        $this->reset('lastname','firstname','email','phone','quantity','type_package_id','lieu_livraison');
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
