<?php

namespace App\Livewire\Almond;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class AlmondComponent extends Component
{   
    use WithPagination;
    public $almondId;

    #[Url] 
    public $search = '';
    public $selectedLimitPaginate; 
    public $isOpen = 0;
    public $isOpenDelete = 0;

    public function __construct()
    {
        $this->selectedLimitPaginate = '10';
    }


    public function resetSearch(){
        $this->search='';
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }

    public function show($id)
    {
        return redirect(route('almond.show',$id));
    }

    public function query()
    {
        $query = Purchase::with(['farmer', 'agribusiness'])
                     ->where(function($q) {
                         $q->where('type_purchase', 'like', '%' . $this->search . '%')
                           ->orWhere('quality', 'like', '%' . $this->search . '%')
                           ->orWhere('weight', 'like', '%' . $this->search . '%')
                           ->orWhere('amount', 'like', '%' . $this->search . '%');
                     })
                     ->paginate($this->selectedLimitPaginate);

    return $query;
    }

    public function render()
    {
        $almonds = $this->query();
        
        return view('livewire.almond.almond-component',[
            'almonds'=>$almonds
        ]);
    }
}
