<?php

namespace App\Livewire;

use App\Models\marxant;
use App\Models\Parada;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MakeParada extends Component
{
    use WithFileUploads;

    // Atributos del formulario
    public $numero;
    public $marxant_id;
    public $data_alta;
    public $data_last_renovation;
    public $actiu = 'Si';
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

    // Para la búsqueda del marxant
    public $searchTerm = '';
    public $searchResults = [];
    public $selectedMarxant = null;

    // Única propiedad para las opciones de actividad
    public $activitatOptions = [];

    // Arrays para opciones de actividades por sector
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

    // Validación


protected function rules()
{
    return [
        'numero' => [
            'required',
            'string',
            'max:100',
            Rule::unique('paradas', 'numero'),
        ],
        'marxant_id' => 'required|exists:marxants,id',
        'data_alta' => 'required|date',
        'data_last_renovation' => 'nullable|date',
         'actiu' => 'required|in:Si,No',
        'tipus_parada' => 'nullable|string|max:100',
        'is_comerc_local' => 'nullable|in:Si,No',
        'sector' => 'required|string',
        'activitat' => 'required|string',
        'formacio_alimentacio' => 'nullable|in:Si,No',
        'metres_lineals' => 'required|numeric|min:0',
        'metres_de_fons' => 'nullable|numeric|min:0',
        'estacionament' => 'required|in:Si,No',
        'ubicacio' => 'required|string|max:150',
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

    'data_last_renovation.date' => 'La data de renovació ha de ser una data vàlida.',

    'tipus_parada.string' => 'El tipus de parada ha de ser una cadena de text.',
    'tipus_parada.max' => 'El tipus de parada no pot tenir més de 100 caràcters.',

    'ubicacio.max' => 'La ubicació no pot tenir més de 150 caracters',
    'ubicacio.required' => 'Has de posar una ubicació',

    'is_comerc_local.in' => 'El valor per a "És comerç local?" ha de ser "Si" o "No".',

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



    // Se ejecuta cuando se monta el componente
    public function mount()
    {
        // Inicializar las opciones de actividad según el sector por defecto
        $this->activitatOptions = $this->activitatsPerSector[$this->sector] ?? [];
    }

    // Se ejecuta cuando cambia el sector
    public function updatedSector()
    {
        $this->activitatOptions = $this->activitatsPerSector[$this->sector] ?? [];
        $this->activitat = ''; // Limpia la activitat seleccionada si cambia de sector
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

    public function selectMarxant($id)
    {
        $this->selectedMarxant = marxant::find($id);
        $this->marxant_id = $id;

        //dd($this->marxant_id);
        $this->searchTerm = '';
        $this->searchResults = [];
    }

    public function clearSelectedMarxant()
    {
        $this->selectedMarxant = null;
        $this->marxant_id = null;
        $this->searchTerm = '';
        $this->searchResults = [];
    }

    public function removeImage($index)
    {
        array_splice($this->imatges, $index, 1);
    }

    public function removeFile($index)
    {
        array_splice($this->fitxers_adjuntats, $index, 1);
    }

    public function save()
    {
        $this->validate();
        

    $imatgesPaths = [];
    foreach ($this->imatges as $image) {
        $path = $image->store('imatges', 'public');
        $imatgesPaths[] = [
            'path' => Storage::url($path),
            'name' => basename($path)
        ];
    }

    $fitxersPaths = [];
    foreach ($this->fitxers_adjuntats as $file) {
        $path = $file->store('fitxers', 'public');
        $fitxersPaths[] = [
            'ruta' => Storage::url($path),
            'nom' => basename($path)
        ];
    }

        if ($this->is_comerc_local === '') {
        $this->is_comerc_local = null;
        }

        if ($this->formacio_alimentacio === '') {
        $this->formacio_alimentacio = null;
        }

        //dd($this->marxant_id);
        // Crear parada
        Parada::create([
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
            'imatges' => json_encode($imatgesPaths),
            'fitxers_adjuntats' => json_encode($fitxersPaths),
            'observacions' => $this->observacions,
        ]);

        session()->flash('message', 'Parada creada correctament!');
        $this->redirect('/paradas'); 
        
    }


    // En el componente PHP
    public function changeSector($value)
    {
        $this->sector = $value;
        $this->activitatOptions = $this->activitatsPerSector[$this->sector] ?? [];
        $this->activitat = '';
    }


    public function render()
    {
        return view('livewire.make-parada');
    }
}