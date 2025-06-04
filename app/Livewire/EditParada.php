<?php

namespace App\Livewire;

use App\Models\Parada;
use App\Models\marxant;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EditParada extends Component
{
    use WithFileUploads;

    public $id;
    public $numero;
    public $marxant_id;
    public $data_alta;
    public $data_last_renovation;
    public $actiu;
    public $tipus_parada;
    public $is_comerc_local;
    public $sector;
    public $activitat;
    public $formacio_alimentacio;
    public $metres_lineals;
    public $metres_de_fons;
    public $estacionament = 'Si';
    public $imatges = [];
    public $fitxers_adjuntats = [];
    public $observacions;
    public $ubicacio;

    // Nuevas propiedades para manejar archivos existentes
    public $existing_images = [];
    public $existing_files = [];
    
    public $searchTerm = '';
    public $searchResults = [];
    public $selectedMarxant = null;

     public $activitatOptions = [];

    public $activitatsPerSector = [
        'Alimentació' => [
            'Altres Alimentació',
            'Bar i restauració',
            'Caramels, dolços i fruit secs',
            'Embotits, xarcuteria o formatges',
            'Fruita',
            'Fruita i verdura',
            'Infusions, espècies i plantes aromàtiques',
            'Olives i Pesca Salada',
            'Ous',
            'Pa i derivats',
            'Pastisseria i brioxeria',
            'Pollastre a l ast i menjar preparat',
            'Producte de temporada',
            'Queviures',
            'Verdura',
            'Xurreria, altres masses i patates fregides'
        ],
        'Equipament de la llar' => [
            'Parament de la llar',
            'Decoració',
            'Ferreteria',
            'Eines',
            'Mobiliari',
            'Electrodomèstics',
            'Tèxtil de la llar',
            'Articles de bany i cuina',
            'Plantes i flors'
        ],
        'Equipament de la persona' => [
            'Roba i complements',
            'Sabateria',
            'Joieria i bijuteria',
            'Rellotgeria',
            'Òptica',
            'Articles de pell',
            'Accessoris de moda'
        ],
        'Lleure i cultura' => [
            'Llibres i revistes',
            'Material escolar',
            'Jocs i joguines',
            'Música i instruments',
            'Articles d\'esport',
            'Tecnologia i electrònica',
            'Artesania',
            'Regals i souvenirs'
        ],
        'Drogeria i Cosmetica' => [
            'Productes de neteja',
            'Cosmètica natural',
            'Perfumeria',
            'Higiene personal',
            'Parafarmàcia',
            'Herboristeria'
        ],
        'Textil i Moda' => [
            'Roba de dona',
            'Roba d\'home',
            'Roba infantil',
            'Roba interior',
            'Moda juvenil',
            'Moda de bany',
            'Complements tèxtils',
            'Merceria i fils'
        ],
        'Sense Informació' => [
            'Sense Informació'
        ]
    ];

    protected $rules = [
        'numero' => 'required|string|max:100',
        'marxant_id' => 'required|exists:marxants,id',
        'data_alta' => 'required|date',
        'data_last_renovation' => 'nullable|date',
        'actiu' => 'required|in:Si,No',
        'tipus_parada' => 'nullable|string',
        'is_comerc_local' => 'nullable|in:Si,No',
        'sector' => 'required|string',
        'activitat' => 'required|string',
        'formacio_alimentacio' => 'nullable|in:Si,No',
        'metres_lineals' => 'required|numeric|min:0',
        'metres_de_fons' => 'nullable|numeric|min:0',
        'estacionament' => 'required|in:Si,No',
        'imatges.*' => 'nullable|image|max:2048',
        'fitxers_adjuntats.*' => 'nullable|file|max:10240',
        'observacions' => 'nullable|string',
    ];


    protected function rules()
    {
    return [
        'numero' => [
            'required',
            'string',
            'max:100',
            Rule::unique('paradas', 'numero')->ignore($this->id),
        ],
        'marxant_id' => 'required|exists:marxants,id',
        'data_alta' => 'required|date',
        'data_last_renovation' => 'nullable|date',
        'tipus_parada' => 'nullable|string|max:100',
        'sector' => 'required|string',
        'activitat' => 'required|string',
        'metres_lineals' => 'required|numeric|min:0',
        'metres_de_fons' => 'nullable|numeric|min:0',
        'ubicacio' => 'required|string|max:150',
        'estacionament' => 'required|in:Si,No',
        'imatges.*' => 'sometimes|nullable|image|max:2048', // 2MB
        'fitxers_adjuntats.*' => 'sometimes|nullable|file|max:10240', // 10MB
        'observacions' => 'nullable|string|max:65535',
    ];
    }

    protected $messages = [
    'numero.required' => 'El número de parada és obligatori.',
    'numero.string' => 'El número ha de ser una cadena de text.',
    'numero.max' => 'El número no pot tenir més de 100 caràcters.',
    'numero.unique' => 'Aquest número de parada ja existeix.',

    'marxant_id.required' => 'Has de seleccionar un marxant.',
    'marxant_id.exists' => 'El marxant seleccionat no és vàlid.',

    'data_alta.required' => 'La data d\'alta és obligatòria.',
    'data_alta.date' => 'La data d\'alta ha de ser una data vàlida.',

    'ubicacio.max' => 'La ubicació no pot tenir més de 150 caracters',
    'ubicacio.required' => 'Has de posar una ubicació',

    'data_last_renovation.date' => 'La data de renovació ha de ser una data vàlida.',

    'tipus_parada.string' => 'El tipus de parada ha de ser una cadena de text.',
    'tipus_parada.max' => 'El tipus de parada no pot tenir més de 100 caràcters.',

    'sector.required' => 'El sector és obligatori.',
    

    'activitat.required' => 'L\'activitat és obligatòria.',
   

    'formacio_alimentacio.in' => 'El valor per a "Formació en alimentació" ha de ser "Si" o "No".',

    'metres_lineals.required' => 'Els metres lineals són obligatoris.',
    'metres_lineals.numeric' => 'Els metres lineals han de ser un número.',
    'metres_lineals.min' => 'Els metres lineals han de ser com a mínim 0.',

    'metres_de_fons.numeric' => 'Els metres de fons han de ser un número.',
    'metres_de_fons.min' => 'Els metres de fons han de ser com a mínim 0.',

    'estacionament.required' => 'Has d\'indicar si hi ha estacionament.',
    'estacionament.in' => 'El valor per a "Estacionament" ha de ser "Si" o "No".',

    'imatges.*.image' => 'Tots els fitxers d\'imatge han de ser vàlids.',
    'imatges.*.max' => 'La mida màxima de cada imatge és de 2MB.',

    'fitxers_adjuntats.*.file' => 'Tots els fitxers adjuntats han de ser arxius vàlids.',
    'fitxers_adjuntats.*.max' => 'La mida màxima de cada fitxer és de 10MB.',

    'observacions.string' => 'Les observacions han de ser una cadena de text.',
];



    public function render()
    {
        return view('livewire.edit-parada');
    }

    public function mount($id)
{
    $this->id = $id;
    $parada = Parada::findOrFail($id);

    // Carga directa de atributos básicos
    $this->numero = $parada->numero;
    $this->marxant_id = $parada->marxant_id;
    $this->data_alta = optional($parada->data_alta)->format('Y-m-d');
    $this->data_last_renovation = optional($parada->data_last_renovation)->format('Y-m-d');
    $this->actiu = $parada->actiu;
    $this->tipus_parada = $parada->tipus_parada;
    $this->is_comerc_local = $parada->is_comerc_local ?? null;
    $this->sector = $parada->sector;
    $this->activitat = $parada->activitat;
    $this->formacio_alimentacio = $parada->formacio_alimentacio;
    $this->metres_lineals = $parada->metres_lineals;
    $this->metres_de_fons = $parada->metres_de_fons;
    $this->estacionament = $parada->estacionament ?? 'Si';
     $this->ubicacio = $parada->ubicacio;
    $this->observacions = $parada->observacions;

    

    // Cargar opciones según sector
    $this->activitatOptions = $this->activitatsPerSector[$this->sector] ?? [];

    // Imatges existents
    $this->existing_images = match (true) {
        is_string($parada->imatges) => json_decode($parada->imatges, true) ?? [],
        is_array($parada->imatges) => $parada->imatges,
        default => [],
    };

    // Fitxers adjuntats existents
    $this->existing_files = match (true) {
        is_string($parada->fitxers_adjuntats) => json_decode($parada->fitxers_adjuntats, true) ?? [],
        is_array($parada->fitxers_adjuntats) => $parada->fitxers_adjuntats,
        default => [],
    };

    // Inicializar listas vacías para nuevos archivos
    $this->imatges = [];
    $this->fitxers_adjuntats = [];

    // Cargar marxant si está definido
    if ($this->marxant_id) {
        $this->selectedMarxant = Marxant::find($this->marxant_id);
    }
}


    public function searchMarxant()
    {
        if (strlen($this->searchTerm) >= 2) {
            $this->searchResults = marxant::where('nom', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('nif', 'like', '%' . $this->searchTerm . '%')
                ->limit(5)
                ->get();
        } else {
            $this->searchResults = [];
        }
    }

    public function updatedSector()
    {
        $this->activitatOptions = $this->activitatsPerSector[$this->sector] ?? [];
        $this->activitat = ''; // Limpia la activitat seleccionada si cambia de sector
    }

    public function changeSector($value)
    {
        $this->sector = $value;
        $this->activitatOptions = $this->activitatsPerSector[$this->sector] ?? [];
        $this->activitat = '';
    }

    public function selectMarxant($id)
    {
        $this->selectedMarxant = marxant::find($id);
        $this->marxant_id = $this->selectedMarxant->id;
        $this->searchTerm = '';
        $this->searchResults = [];
    }

    public function clearSelectedMarxant()
    {
        $this->selectedMarxant = null;
        $this->marxant_id = null;
    }

    public function removeExistingImage($index)
    {
        if (isset($this->existing_images[$index])) {
            $imageToRemove = $this->existing_images[$index];
            
            // Eliminar el archivo del storage
            if (Storage::exists('public/parades/' . $imageToRemove)) {
                Storage::delete('public/parades/' . $imageToRemove);
            }
            
            // Remover del array
            unset($this->existing_images[$index]);
            $this->existing_images = array_values($this->existing_images);
        }
    }

    public function removeImage($index)
    {
        if (isset($this->imatges[$index])) {
            unset($this->imatges[$index]);
            $this->imatges = array_values($this->imatges);
        }
    }

    public function removeExistingFile($index)
    {
        if (isset($this->existing_files[$index])) {
            $fileToRemove = $this->existing_files[$index];
            
            // Eliminar el archivo del storage
            if (Storage::exists('public/documents/' . $fileToRemove)) {
                Storage::delete('public/documents/' . $fileToRemove);
            }
            
            // Remover del array
            unset($this->existing_files[$index]);
            $this->existing_files = array_values($this->existing_files);
        }
    }

    public function removeFile($index)
    {
        if (isset($this->fitxers_adjuntats[$index])) {
            unset($this->fitxers_adjuntats[$index]);
            $this->fitxers_adjuntats = array_values($this->fitxers_adjuntats);
        }
    }

    

public function save()
{
    $this->validate();

    $parada = Parada::find($this->id);


    if ($this->is_comerc_local === '') {
    $this->is_comerc_local = null;
    }

    if ($this->formacio_alimentacio === '') {
    $this->formacio_alimentacio = null;
    }


    // Actualizar campos
    $parada->fill([
        'numero' => $this->numero,
        'marxant_id' => $this->marxant_id,
        'data_alta' => $this->data_alta,
        'data_last_renovation' => $this->data_last_renovation,
        'actiu' => $this->actiu,
        'tipus_parada' => $this->tipus_parada,
        'is_comerc_local' => $this->is_comerc_local,
        'sector' => $this->sector,
        'activitat' => $this->activitat,
        'formacio_alimentacio' => $this->formacio_alimentacio,
        'metres_lineals' => $this->metres_lineals,
        'metres_de_fons' => $this->metres_de_fons,
        'estacionament' => $this->estacionament,
        'ubicacio' => $this->ubicacio,
        'observacions' => $this->observacions,
    ]);

   

    // -------------------------------
    // IMATGES
    $imatges = $this->existing_images ?? [];

    if (!empty($this->imatges) && is_array($this->imatges)) {
        foreach ($this->imatges as $image) {
            if ($image) {
                $path = $image->store('imatges', 'public');
                $imatges[] = [
                    'path' => Storage::url($path),
                    'name' => basename($path),
                ];
            }
        }
    }

    $parada->imatges = $imatges;

    // -------------------------------
    // FITXERS
    $fitxers = $this->existing_files ?? [];

    if (!empty($this->fitxers_adjuntats) && is_array($this->fitxers_adjuntats)) {
        foreach ($this->fitxers_adjuntats as $file) {
            if ($file) {
                $path = $file->store('fitxers', 'public');
                $fitxers[] = [
                    'ruta' => Storage::url($path),
                    'nom' => basename($path),
                ];
            }
        }
    }

    $parada->fitxers_adjuntats = $fitxers;

    // -------------------------------
    $parada->save();

    session()->flash('message', 'Parada actualitzada correctament.');
       $this->redirect('/paradas'); 
}

}