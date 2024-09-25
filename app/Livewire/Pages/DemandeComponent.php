<?php

namespace App\Livewire\Pages;

use App\Models\Demande;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class DemandeComponent extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';
    public $selectedLimitPaginate;
    public $isOpen = 0;

    public $nom, $prenoms, $email, $phone, $qte, $offreId, $typePackageId;

    public function __construct()
    {
        $this->selectedLimitPaginate = '50';
    } 

    public function query()
    {
        $query = Demande::with('');
    }


    public function render()
    {
        return view('livewire.pages.demande-component');
    }
}
