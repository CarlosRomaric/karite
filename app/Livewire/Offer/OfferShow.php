<?php

namespace App\Livewire\Offer;

use App\Models\Offer;
use App\Models\Parc;
use App\Models\Sealed;
use Livewire\Component;

class OfferShow extends Component
{
    public $offerId, $offer;
    public $parcs, $scelles;

    public function mount()
    {
        $this->offer = Offer::where('id',$this->offerId)->first();
       
        $this->parcs = Parc::where('agribusiness_id', $this->offer->agribusiness_id)->get();
        $this->scelles = $this->offer->sealed;
    }

    public function render()
    {
        return view('livewire.offer.offer-show');
    }
}
