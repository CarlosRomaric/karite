<?php

namespace App\Livewire\Agribusinesses;

use App\Models\Parc;
use App\Models\User;
use Livewire\Component;
use App\Models\Agribusiness;
use App\Utilities\NewSmsAPI;

class AgribusinessShow extends Component
{
    public $activeTab = 'cooperative';
    public $agribusiness;
    public $numRegistreCommerce;
    public $agribusinessId;
    public $matricule, $denomination, $sigle, $address, $region_id, $departement_id, $headquaters, $bank, $certification, $registre_commerce, $dfe, $number_sections, $number_unite_transformations, $logo, $status; 
    public $pca, $sup, $photo_pca, $photo_sup;
    public $statusFilter;
    public $agribusinessFilter;
    public $regions, $departements;
    public $doc_dfe, $doc_registre_commerce;
    public $statusCoop;
    public $parcs;

    public $motif;
    public $close = 0;

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function mount(){
        $this->agribusiness = Agribusiness::find($this->agribusinessId);
        $this->pca = User::where('agribusiness_id',$this->agribusiness->id)->where('job','PCA')->first();
        $this->sup = User::where('agribusiness_id',$this->agribusiness->id)->where('job','SUPERVISEUR')->first();
        if(!empty($this->photo_pca) && !is_null($this->photo_pca)){
            $this->photo_pca =  str_replace('public/', '', $this->pca->picture);
        }
        if(!empty($this->photo_sup) && !is_null($this->photo_sup))
        {
            $this->photo_sup =  str_replace('public/', '', $this->sup->picture);
        }
        $this->parcs = Parc::where('agribusiness_id',$this->agribusiness->id)->get();
        $this->statusCoop = $this->agribusiness->status;
    }



    public function valideCoop($id){
        if($this->motif != '' ){

            $agribusiness = Agribusiness::find($id);
            $agribusiness->status = 1;
            $agribusiness->motif = $this->motif;
            $agribusiness->save();
            if(!empty(session('errorMotif'))){
                session()->forget('errorMotif');
            }
            $this->pca = User::where('agribusiness_id',$this->agribusinessId)->where('job','PCA')->first();
            $this->sup = User::where('agribusiness_id',$this->agribusinessId)->where('job','SUPERVISEUR')->first();
            
                $messageSender = new NewSmsAPI();
               
                $messagePca ='[Karité 2.0]: Vos accès pour vous connecter Login: '.$this->pca->phone.' Mot de passe est: '.$this->pca->phone.' Lien de téléchargement de l’application: XXXXXXXXXXX';
                $messageSender->sendSMS([$this->pca->phone], $messagePca);

                if(!empty($this->sup))
                {
                    $messageSup ='[Karité 2.0]: Vos accès pour vous connecter Login: '.$this->sup->phone.' Mot de passe est: '.$this->sup->phone.' Lien de téléchargement de l’application: XXXXXXXXXXX';
                    $messageSender->sendSMS([$this->sup->phone], $messageSup);
                }
                $this->dispatch('validateCoop', ['message' => 'la coopérative a bien été validé']);
            
            $this->closeModalShow();
        }else{
            session()->put('errorMotif','Vous devez renseigner le motif pour valider');
        }
    }

    public function rejetCoop($id){
        
        if($this->motif != '' ){
       
            $agribusiness = Agribusiness::find($id);
            $agribusiness->status = 2;
            $agribusiness->motif = $this->motif;
            $agribusiness->save();
            if(!empty(session('errorMotif'))){
                session()->forget('errorMotif');
            }
            $this->pca = User::where('agribusiness_id',$agribusiness->id)->where('job','PCA')->first();
            $this->sup = User::where('agribusiness_id',$agribusiness->id)->where('job','SUPERVISEUR')->first();

            $messageSender = new NewSmsAPI();
            $message ='votre demande de création de coopérative a échoué car pour motif: '.$this->motif;
           
            $messageSender->sendSMS([$this->sup->phone], $message);
            $messageSender->sendSMS([$this->pca->phone], $message);
            $this->closeModalShow();

        }else{
            session()->put('errorMotif','Vous devez renseigner le motif pour rejeter');
        }
    }

        // Exemple de méthodes pour récupérer les données
        protected function getAgribusiness()
        {
            // Récupère les informations de la coopérative
            return [
                'denomination' => $this->agribusiness->denominataion,
                'sigle' => $this->agribusiness->sigle,
                'Régistre du commerce' => $this->agribusiness->numRegsitreCommerce,
                'email' => $this->agribusiness->email,
                'postal' => $this->agribusiness->address
            ];
        }

        protected function getPca()
        {
            return (object) [
                'fullname' => $this->pca->fullname??'',
                'phone' => $this->pca->phone??'',
                'email' => $this->pca->email??'',
            ];
        }
    
        protected function getSuperviseur()
        {
            return (object) [
                'fullname' => $this->sup->fullname??'',
                'phone' => $this->sup->phone??'',
                'email' => $this->sup->email??'',
            ];
        }

        protected function getParcs()
        {
            return $this->parcs;
        }

    public function render()
    {

        return view('livewire.agribusinesses.agribusiness-show',[
            'agribusiness' => $this->getAgribusiness(),
            'pca' => $this->getPca(),
            'sup' => $this->getSuperviseur(),
            'parcs' => $this->getParcs(),
        ]);
    }
    
}
