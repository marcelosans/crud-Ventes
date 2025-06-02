<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\marxant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EditarMarxant extends Component
{
    use WithFileUploads;

    public $id;
    public $nom;
    public $nif;
    public $data_naixement;
    public $telefon_fix;
    public $telefon_mobil;
    public $correu;
    public $adreca;
    public $codi_postal;
    public $regim_ss = 'Altres'; // Valor por defecto
    public $asseguranca;
    public $observacions;
    public $imatges = [];
    public $fitxers_adjuntats = [];
    public $dades_publiques = 'Si'; // Valor por defecto
    public $created_at;
    public $updated_at;
    
    // Para las imágenes y archivos existentes
    public $imatges_existents = [];
    public $fitxers_existents = [];

    // Reglas de validación
    protected function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'nif' => [
                'required',
                'string',
                'max:15',
                Rule::unique('marxants', 'nif')->ignore($this->id),
            ],
            'data_naixement' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'telefon_fix' => 'nullable|string|max:20',
            'telefon_mobil' => 'nullable|string|max:20',
            'correu' => [
                'nullable',
                'email',
                'max:100',
                Rule::unique('marxants', 'correu')->ignore($this->id),
            ],
            'adreca' => 'nullable|string|max:150',
            'codi_postal' => 'nullable|string|max:10',
            'regim_ss' => 'required|in:Altres,Autònom,Cooperativista,No Consta',
            'asseguranca' => 'nullable|string|max:100',
            'observacions' => 'nullable|string|max:65535', // longText → màxim teòric
            'imatges.*' => 'nullable|image|max:20480',
            'fitxers_adjuntats.*' => 'nullable|file|max:20480',
            'dades_publiques' => 'required|in:Si,No',
        ];
        
    }

    // Mensajes de error personalizados
    protected $messages = [
        'nom.required' => 'El nom és obligatori.',
        'nif.required' => 'El NIF és obligatori.',
        'nif.unique' => 'Aquest NIF ja existeix.',
        'data_naixement.required' => 'La data de naixement és obligatòria.',
        'data_naixement.before_or_equal' => 'Has de tenir almenys 18 anys.',
        'correu.email' => 'El format del correu electrònic no és vàlid.',
        'correu.unique' => 'Aquest correu electrònic ja existeix.',
        'imatges.*.max' => 'La mida màxima per imatge és de 2MB.',
        'fitxers_adjuntats.*.max' => 'La mida màxima per fitxer és de 20MB.',
    ];

    public function mount($id)
    {
        $this->id = $id;
        $marxant = marxant::findOrFail($id);

        $this->nom = $marxant->nom;
        $this->nif = $marxant->nif;
        $this->data_naixement = optional($marxant->data_naixement)->format('Y-m-d');
        $this->telefon_fix = $marxant->telefon_fix;
        $this->telefon_mobil = $marxant->telefon_mobil;
        $this->correu = $marxant->correu;
        $this->adreca = $marxant->adreca;
        $this->codi_postal = $marxant->codi_postal;
        $this->regim_ss = $marxant->regim_ss;
        $this->asseguranca = $marxant->asseguranca;
        $this->observacions = $marxant->observacions;
        $this->dades_publiques = $marxant->dades_publiques;
        
        // Cargar imágenes y archivos existentes si están almacenados como JSON
        if ($marxant->imatges) {
            $this->imatges_existents = json_decode($marxant->imatges, true) ?? [];
        }
        
        if ($marxant->fitxers_adjuntats) {
            $this->fitxers_existents = json_decode($marxant->fitxers_adjuntats, true) ?? [];
        }
    }
    
    // Método para eliminar una imagen temporal
    public function removeImage($index)
    {
        array_splice($this->imatges, $index, 1);
    }
    
    // Método para eliminar un archivo temporal
    public function removeFile($index)
    {
        array_splice($this->fitxers_adjuntats, $index, 1);
    }
    
    // Método para eliminar una imagen existente
    public function removeExistingImage($index)
    {
        array_splice($this->imatges_existents, $index, 1);
    }
    
    // Método para eliminar un archivo existente
    public function removeExistingFile($index)
    {
        array_splice($this->fitxers_existents, $index, 1);
    }

    public function save()
    {
        $this->validate();
        
        $marxant = marxant::findOrFail($this->id);
        
        // Actualizar datos básicos
        $marxant->nom = $this->nom;
        $marxant->nif = $this->nif;
        $marxant->data_naixement = $this->data_naixement;
        $marxant->telefon_fix = $this->telefon_fix;
        $marxant->telefon_mobil = $this->telefon_mobil;
        $marxant->correu = $this->correu;
        $marxant->adreca = $this->adreca;
        $marxant->codi_postal = $this->codi_postal;
        $marxant->regim_ss = $this->regim_ss;
        $marxant->asseguranca = $this->asseguranca;
        $marxant->observacions = $this->observacions;
        $marxant->dades_publiques = $this->dades_publiques;
        
        // Crear directorio basado en el NIF del marxant
        $nifDirectori = str_replace(['/', '\\', ' ', '.'], '_', $this->nif); // Sanitizar NIF para usarlo como nombre de directorio
        $baseDirectori = "marxants/{$nifDirectori}";
        
        // Manejar carga de nuevas imágenes
        if (!empty($this->imatges)) {
            $novas_imatges = [];
            
            // Asegurar que existe el directorio de imágenes para este marxant
            $directoriImatges = "{$baseDirectori}/imatges";
            
            foreach ($this->imatges as $imatge) {
                $rutaImatge = $imatge->store($directoriImatges, 'public');
                $novas_imatges[] = $rutaImatge;
            }
            
            
            $totes_imatges = array_merge($this->imatges_existents, $novas_imatges);
            $marxant->imatges = json_encode($totes_imatges);
        } else {
            
            $marxant->imatges = !empty($this->imatges_existents) ? json_encode($this->imatges_existents) : null;
        }
        
       
        if (!empty($this->fitxers_adjuntats)) {
            $nous_fitxers = [];
            
            
            $directoriFitxers = "{$baseDirectori}/fitxers";
            
            foreach ($this->fitxers_adjuntats as $fitxer) {
                $rutaFitxer = $fitxer->store($directoriFitxers, 'public');
                $nous_fitxers[] = [
                    'ruta' => $rutaFitxer,
                    'nom' => $fitxer->getClientOriginalName(),
                    'tipus' => $fitxer->getClientMimeType(),
                    'mida' => $fitxer->getSize()
                ];
            }
            
           
            $tots_fitxers = array_merge($this->fitxers_existents, $nous_fitxers);
            $marxant->fitxers_adjuntats = json_encode($tots_fitxers);
        } else {
            
            $marxant->fitxers_adjuntats = !empty($this->fitxers_existents) ? json_encode($this->fitxers_existents) : null;
        }
        
        $marxant->save();
        
       
        session()->flash('message', 'Marxant actualitzat correctament');
        
        
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.editar-marxant');
    }
}