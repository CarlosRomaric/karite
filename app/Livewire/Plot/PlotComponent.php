<?php

namespace App\Livewire\Plot;

use App\Models\Plot;
use App\Models\Farmer;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PlotComponent extends Component
{
    use WithPagination, WithFileUploads;
    
    public $total_area, $gps_track, $farmer_id, $latitude, $longitude, $plotId, $_gps_code;
    public $farmerId;
    
    public function mount($farmerId)
    {
        $this->farmerId = $farmerId;
    }

    public function editPlot($id){
       
        $plot = Plot::findOrFail($id);
        //dd($plot);
        $this->total_area = $plot->total_area;
        $this->latitude = $plot->latitude;
        $this->longitude = $plot->longitude;
        $this->_gps_code = $plot->gps_code;
        $this->gps_track = $plot->gps_track;
    }

    public function update(){
        $plot = Plot::findOrFail($this->plotId);
        $plot->update([
            'total_area'=>$this->total_area,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'gps_code'=>$this->gps_code,
            'gps_track'=>$this->gps_track,
        ]);
        session()->flash('message', 'les informations de la parcelle ont bien  été modifié avec success');
    }

    public function render()
    {
        $plots = Plot::where('farmer_id',$this->farmerId)->get();
        $data = [
            'plots'=>$plots
        ];
        return view('livewire.plot.plot-component')->with($data);
    }
}
