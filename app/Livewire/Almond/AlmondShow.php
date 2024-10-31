<?php

namespace App\Livewire\Almond;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Agribusiness;

class AlmondShow extends Component
{
    public $almond, $almondId;

    public function mount()
    {
        $this->almond = Purchase::find($this->almondId);
    }


    public function render()
    {
        return view('livewire.almond.almond-show');
    }
}
