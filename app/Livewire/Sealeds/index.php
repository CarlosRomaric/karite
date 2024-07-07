<?php

namespace App\Livewire\Sealeds;

use Carbon\Carbon;
use App\Models\Lot;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Index extends Component
{
    use WithPagination, WithFileUploads;

    #[Url] 
    public $search = '';
    public $selectedLimitPaginate; 
      
    public function __construct()
    {
        $this->selectedLimitPaginate = '10';
      
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }
 
    #[On('get-limit-paginate')] 
    public function getLmitPaginate($value){
        $this->selectedLimitPaginate = $value;
    }

    public function query(){
        
        $query = Lot::where('code','like','%'.$this->search.'%')
                        // ->orWhere('phone','like','%'.$this->search.'%')
                        ->where('agribusiness_id','!=',null)
                        ->paginate($this->selectedLimitPaginate);
       
        return $query;
    }

    public function render()
    {
        return view('livewire.sealeds.index',[
            'lots'=>$this->query(),
        ]);
    }
}
