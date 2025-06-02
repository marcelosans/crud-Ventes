<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\marxant;

class HomePage extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Propiedades para filtrado y búsqueda
    public $search = '';
    public $perPage = 10;
    public $sortField = 'nom';
    public $sortDirection = 'asc';

    // Propiedades para el modal de detalles
    public $modalOpen = false;
    public $selectedMarxant = null;
    public $imatges = [];
    public $fitxers = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'nom'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $marxants = marxant::query()
            ->when($this->search, function ($query) {
                return $query->where('nom', 'like', '%' . $this->search . '%')
                    ->orWhere('nif', 'like', '%' . $this->search . '%')
                    ->orWhere('correu', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.home-page', ['marxants' => $marxants]);
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
     * Abre el modal con los detalles del marxant
     */
    public function openModal($id)
    {
        $this->selectedMarxant = marxant::findOrFail($id);
        
        // Cargamos las imágenes si existen
        if ($this->selectedMarxant->imatges) {
            $imagesData = json_decode($this->selectedMarxant->imatges, true) ?? [];
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
        
        // Cargamos los ficheros si existen
        if ($this->selectedMarxant->fitxers_adjuntats) {
            $filesData = json_decode($this->selectedMarxant->fitxers_adjuntats, true) ?? [];
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
        $this->selectedMarxant = null;
        $this->imatges = [];
        $this->fitxers = [];
    }

    /**
     * Redirige a la página de edición del marxant
     */
    public function updateMarxant($id)
    {
        return redirect()->to('editar-marxant/' . $id);
    }

    /**
     * Elimina un marxant
     */
    public function deleteMarxant($id)
    {
        $marxant = marxant::find($id);
        if ($marxant) {
            $marxant->delete();
            session()->flash('message', 'Marxant eliminat correctament.');
        }
    }
}