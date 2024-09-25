<?php

namespace App\Livewire\Pages;

use App\Models\Offer;
use Livewire\Component;

class OrderCreate extends Component
{
    public $offerId;



    public function render()
    {
        $offer = Offer::find($this->offerId);
        $data = [
            'offer'=>$offer
        ];
        return view('livewire.pages.order-create')->with($data);
    }
}
