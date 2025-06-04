<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\marxant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FerMarxants extends Component
{
    use WithFileUploads;

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
    public $actiu = 'Si';

    // Reglas de validación
    protected function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'nif' => [
                'required',
                'string',
                'max:15',
                Rule::unique('marxants', 'nif')
            ],
            'data_naixement' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'telefon_fix' => 'nullable|string|max:20',
            'telefon_mobil' => 'nullable|string|max:20',
            'correu' => [
                'nullable',
                'email',
                'max:100',
                Rule::unique('marxants', 'correu')
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

    public function save()
    {
        $this->validate();
        
        // Crear directorio basado en el NIF del marxant
        $nifDirectori = str_replace(['/', '\\', ' ', '.'], '_', $this->nif); // Sanitizar NIF para usarlo como nombre de directorio
        $baseDirectori = "marxants/{$nifDirectori}";
        
        // Manejar carga de imágenes
        $imatges_guardades = [];
        if (!empty($this->imatges)) {
            // Asegurar que existe el directorio de imágenes para este marxant
            $directoriImatges = "{$baseDirectori}/imatges";
            
            foreach ($this->imatges as $imatge) {
                $rutaImatge = $imatge->store($directoriImatges, 'public');
                $imatges_guardades[] = $rutaImatge;
            }
        }
        
        // Manejar carga de archivos adjuntos
        $fitxers_guardats = [];
        if (!empty($this->fitxers_adjuntats)) {
            // Asegurar que existe el directorio de ficheros para este marxant
            $directoriFitxers = "{$baseDirectori}/fitxers";
            
            foreach ($this->fitxers_adjuntats as $fitxer) {
                $rutaFitxer = $fitxer->store($directoriFitxers, 'public');
                $fitxers_guardats[] = [
                    'ruta' => $rutaFitxer,
                    'nom' => $fitxer->getClientOriginalName(),
                    'tipus' => $fitxer->getClientMimeType(),
                    'mida' => $fitxer->getSize()
                ];
            }
        }
        
        // Creación del registro en la base de datos
        $marxant = marxant::create([
            'nom' => $this->nom,
            'nif' => $this->nif,
            'data_naixement' => $this->data_naixement,
            'telefon_fix' => $this->telefon_fix,
            'telefon_mobil' => $this->telefon_mobil,
            'correu' => $this->correu,
            'adreca' => $this->adreca,
            'codi_postal' => $this->codi_postal,
            'regim_ss' => $this->regim_ss,
            'asseguranca' => $this->asseguranca,
            'observacions' => $this->observacions,
            'actiu' => $this->actiu,
            'imatges' => !empty($imatges_guardades) ? json_encode($imatges_guardades) : null,
            'fitxers_adjuntats' => !empty($fitxers_guardats) ? json_encode($fitxers_guardats) : null,
            'dades_publiques' => $this->dades_publiques,
        ]);
        
        // Limpiar el formulario después de guardar, pero mantener los valores predeterminados
        $this->reset(['nom', 'nif', 'data_naixement', 'telefon_fix', 'telefon_mobil', 'correu', 
                     'adreca', 'codi_postal', 'asseguranca', 'observacions', 'imatges', 'fitxers_adjuntats']);
        
        // Notificar al usuario
        session()->flash('message', 'Marxant creat correctament!');
        
        // Redirigir a la página principal
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.fer-marxants');
    }
}