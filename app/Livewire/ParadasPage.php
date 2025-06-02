<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Parada;
use App\Models\Marxant;

class ParadasPage extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Propiedades para filtrado y búsqueda
    public $search = '';
    public $perPage = 10;
    public $sortField = 'numero';
    public $sortDirection = 'asc';
    public $sectorFilter = '';
    public $activitatFilter = '';
    public $actiuFilter = '';

    // Propiedades para el modal de detalles
    public $modalOpen = false;
    public $selectedParada = null;
    public $imatges = [];
    public $fitxers = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'numero'],
        'sortDirection' => ['except' => 'asc'],
        'sectorFilter' => ['except' => ''],
        'activitatFilter' => ['except' => ''],
        'actiuFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingSectorFilter()
    {
        $this->resetPage();
    }

    public function updatingActivitatFilter()
    {
        $this->resetPage();
    }

    public function updatingActiuFilter()
    {
        $this->resetPage();
    }

    // Métodos adicionales para asegurar la reactividad
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSectorFilter()
    {
        $this->resetPage();
    }

    public function updatedActivitatFilter()
    {
        $this->resetPage();
    }

    public function updatedActiuFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $paradasQuery = Parada::query()
            ->with('marxant') // Cargamos la relación con marxant
            ->when($this->search, function ($query) {
                return $query->where('numero', 'like', '%' . $this->search . '%')
                    ->orWhereHas('marxant', function ($q) {
                        $q->where('nom', 'like', '%' . $this->search . '%')
                            ->orWhere('nif', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->sectorFilter, function ($query) {
                return $query->where('sector', $this->sectorFilter);
            })
            ->when($this->activitatFilter, function ($query) {
                return $query->where('activitat', $this->activitatFilter);
            })
            ->when($this->actiuFilter !== '', function ($query) {
               
                return $query->where('actiu', $this->actiuFilter);
            })
            
            ->orderBy($this->sortField, $this->sortDirection);

        $paradas = $paradasQuery->paginate($this->perPage);

        // Obtenemos listas únicas para los filtros
        $sectores = Parada::distinct()->orderBy('sector')->pluck('sector')->filter();
        $actividades = Parada::distinct()->orderBy('activitat')->pluck('activitat')->filter();

        return view('livewire.paradas-page', [
            'paradas' => $paradas,
            'sectores' => $sectores,
            'actividades' => $actividades,
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Abre el modal con los detalles de la parada
     */
    public function openModal($id)
    {
        $this->selectedParada = Parada::with('marxant')->findOrFail($id);
        
        // Cargamos las imágenes si existen - CORREGIDO
        if ($this->selectedParada->imatges) {
            // Verificamos si ya es un array o si es un string JSON
            if (is_string($this->selectedParada->imatges)) {
                $imagesData = json_decode($this->selectedParada->imatges, true) ?? [];
            } else {
                $imagesData = $this->selectedParada->imatges ?? [];
            }
            
            $this->imatges = [];
            
            // Procesamos cada imagen para asegurar que tenga formato correcto
            foreach ($imagesData as $key => $image) {
                if (is_string($image)) {
                    // Si es string, creamos estructura de array
                    $this->imatges[] = [
                        'path' => $image,
                        'name' => basename($image)
                    ];
                } elseif (is_array($image) && isset($image['path'])) {
                    // Si ya es un array con 'path', lo usamos directamente
                    $this->imatges[] = $image;
                }
            }
        } else {
            $this->imatges = [];
        }
        
        // Cargamos los ficheros si existen - CORREGIDO
        if ($this->selectedParada->fitxers_adjuntats) {
            // Verificamos si ya es un array o si es un string JSON
            if (is_string($this->selectedParada->fitxers_adjuntats)) {
                $filesData = json_decode($this->selectedParada->fitxers_adjuntats, true) ?? [];
            } else {
                $filesData = $this->selectedParada->fitxers_adjuntats ?? [];
            }
            
            $this->fitxers = [];
            
            // Procesamos cada fichero para asegurar que tenga formato correcto
            foreach ($filesData as $file) {
                if (is_array($file) && isset($file['ruta']) && isset($file['nom'])) {
                    $this->fitxers[] = [
                        'path' => $file['ruta'],
                        'name' => $file['nom']
                    ];
                }
            }
        } else {
            $this->fitxers = [];
        }
        
        $this->modalOpen = true;
    }

    /**
     * Cierra el modal de detalles
     */
    public function closeModal()
    {
        $this->modalOpen = false;
        $this->selectedParada = null;
        $this->imatges = [];
        $this->fitxers = [];
    }

    /**
     * Redirige a la página de edición de la parada
     */
    public function updateParada($id)
    {
        return redirect()->to('editar-parada/' . $id);
    }

    /**
     * Elimina una parada
     */
    public function deleteParada($id)
    {
        $parada = Parada::find($id);
        if ($parada) {
            $parada->delete();
            session()->flash('message', 'Parada eliminada correctament.');
        }
    }

    /**
     * Redirige a la página de creación de parada
     */
    public function createParada()
    {
        return redirect()->to('fer-parada');
    }

    /**
     * Resetea todos los filtros
     */
    public function resetFilters()
    {
        $this->search = '';
        $this->sectorFilter = '';
        $this->activitatFilter = '';
        $this->actiuFilter = '';
        $this->resetPage();
    }
}