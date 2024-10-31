<?php

namespace App\Livewire\Pages;

use App\Models\Parc;
use App\Models\Offer;
use Livewire\Component;

class OfferDetail extends Component
{
    public $offerId, $offer;
    public $parcs, $scelles;

    public function mount()
    {
        dd($this->offerId);
        $this->offer = Offer::where('id',$this->offerId)->first();
       
        $this->parcs = Parc::where('agribusiness_id', $this->offer->agribusiness_id)->get();

        $this->scelles = $this->offer->sealed;
    }

    public function render()
    {
        return view('livewire.pages.offer-detail');
    }
}
