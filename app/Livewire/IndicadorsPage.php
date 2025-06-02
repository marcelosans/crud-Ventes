<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Parada;
use App\Models\marxant;


class IndicadorsPage extends Component
{
    public $totalActives;
    public $totalParades;
    public $totalMetresLineals;
    public $totalMetresLinealsActives;
    public $numMarxants;
    public function render()
    {
        return view('livewire.indicadors-page');
    }

    public function mount()
    {
        $this->totalActives = Parada::where('actiu', 'Si')->count();
        $this->totalParades = Parada::count();
        $this->totalMetresLineals = Parada::sum('metres_lineals');
        $this->totalMetresLinealsActives = Parada::where('actiu', 'Si')->sum('metres_lineals');
    }
}
