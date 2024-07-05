<?php

namespace App\Livewire\Offer;

use App\Models\Offer;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class OfferComponent extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $selectedLimitPaginate;
    public $isOpen = 0;
    
    public function __construct()
    {
        $this->selectedLimitPaginate = '50';
    } 

    public function query(){
        
        $query =  Offer::where('certification','like','%'.$this->search.'%')
                        ->orWhere('type_packaging', 'like','%'.$this->search.'%')
                        ->paginate($this->selectedLimitPaginate);
        return $query;
    }

    public function render()
    {
        $offers = $this->query();

        $data = [
            'offers'=>$offers
        ];

        return view('livewire.offer.offer-component', $data);
    }
}
