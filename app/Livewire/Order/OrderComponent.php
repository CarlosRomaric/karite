<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class OrderComponent extends Component
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
        
        $query =  Order::with('offer')
                        ->whereHas('offer', function($query){
                            $query->where('code','like','%'.$this->search.'%');
                        })
                        ->paginate($this->selectedLimitPaginate);
        return $query;
    }

    public function render()
    {
        $orders = $this->query();
        $data = [
            'orders'=> $orders
        ];
        return view('livewire.order.order-component', $data);
    }
}
