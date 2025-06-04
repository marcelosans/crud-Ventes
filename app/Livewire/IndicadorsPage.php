<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Parada;
use App\Models\marxant;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndicadorsPage extends Component
{
    public $totalActives;
    public $totalParades;
    public $totalMetresLineals;
    public $totalMetresLinealsActives;
    public $totalMarxantActiu;
    public $numMarxants;
    public $sectors = [];
    public $activitats = [];
    public $ubicacions = [];
    public $ubicacionsMetres = [];
    public $grups = [];
    
    public function render()
    {
        return view('livewire.indicadors-page');
    }

    public function mount()
    {
        $totalUbicacion = DB::table('paradas')->count();
        $totalMetres = DB::table('paradas')->sum('metres_lineals');

        $this->ubicacions = DB::table('paradas')
            ->select('ubicacio', DB::raw('COUNT(*) as total'))
            ->whereNotNull('ubicacio') 
            ->groupBy('ubicacio')
            ->get()
            ->map(function ($item) use ($totalUbicacion) {
                $item->percentatge = $totalUbicacion > 0 ? round(($item->total / $totalUbicacion) * 100, 2) : 0;
                return $item;
            });
        
         $this->ubicacionsMetres = DB::table('paradas')
            ->select('ubicacio', DB::raw('SUM(metres_lineals) as metres'))
            ->whereNotNull('ubicacio') 
            ->groupBy('ubicacio')
            ->get()
            ->map(function ($item) use ($totalMetres) {
                $item->percentatge = $totalMetres > 0 ? round(($item->metres / $totalMetres) * 100, 2) : 0;
                return $item;
            });

        $total = Parada::count();
        $totalParades = Parada::count();
        $totalMetres = Parada::sum('metres_lineals');

        $this->sectors = Parada::select('sector', DB::raw('count(*) as total'))
            ->groupBy('sector')
            ->get()
            ->map(function ($item) use ($total) {
                $item->percentatge = $total > 0 ? round(($item->total / $total) * 100, 2) : 0;
                return $item;
            });

         $this->grups = Parada::select('metres_lineals', DB::raw('count(*) as total_parades'), DB::raw('sum(metres_lineals) as total_metres'))
            ->groupBy('metres_lineals')
            ->orderBy('metres_lineals')
            ->get()
            ->map(function ($item) use ($totalParades, $totalMetres) {
                $item->percent_parades = $totalParades > 0 ? round(($item->total_parades / $totalParades) * 100, 2) : 0;
                $item->percent_metres = $totalMetres > 0 ? round(($item->total_metres / $totalMetres) * 100, 2) : 0;
                return $item;
            });

         $this->activitats = Parada::select('sector', 'activitat', DB::raw('count(*) as total'))
            ->groupBy('sector', 'activitat')
            ->orderBy('sector')
            ->orderBy('activitat')
            ->get()
            ->map(function ($item) use ($total) {
                $item->percentatge = $total > 0 ? round(($item->total / $total) * 100, 2) : 0;
                return $item;
            });

        $this->totalActives = Parada::where('actiu', 'Si')->count();
        $this->totalParades = Parada::count();
        $this->totalMetresLineals = Parada::sum('metres_lineals');
        $this->totalMetresLinealsActives = Parada::where('actiu', 'Si')->sum('metres_lineals');
        $this->totalMarxantActiu = marxant::where('actiu', 'Si')->count();
    }

    public function downloadUbicacionsCSV()
    {
        return $this->generateCSV($this->ubicacions, 'distribucio_parades_ubicacions.csv', [
            'Ubicació' => 'ubicacio',
            'Nombre de Parades' => 'total',
            'Percentatge' => 'percentatge'
        ]);
    }

    public function downloadUbicacionsMetresCSV()
    {
        return $this->generateCSV($this->ubicacionsMetres, 'metres_lineals_ubicacions.csv', [
            'Ubicació' => 'ubicacio',
            'Metres Lineals' => 'metres',
            'Percentatge' => 'percentatge'
        ]);
    }

    public function downloadGrupsCSV()
    {
        return $this->generateCSV($this->grups, 'metres_lineals_parades.csv', [
            'Metres Lineals' => 'metres_lineals',
            'Numero de Parades' => 'total_parades',
            '% Total Parades' => 'percent_parades',
            'Metres Totals' => 'total_metres',
            '% Total Metres' => 'percent_metres'
        ]);
    }

    public function downloadSectorsCSV()
    {
        return $this->generateCSV($this->sectors, 'sectors_mercat.csv', [
            'Sector' => 'sector',
            'Numero de Parades' => 'total',
            'Percentatge' => 'percentatge'
        ]);
    }

    public function downloadActivitatsCSV()
    {
        return $this->generateCSV($this->activitats, 'activitats_sectors.csv', [
            'Sector' => 'sector',
            'Activitat' => 'activitat',
            'Numero de Parades' => 'total',
            'Percentatge' => 'percentatge'
        ]);
    }

    public function downloadAllCSV()
    {
        return response()->streamDownload(function () {
            $zip = new \ZipArchive();
            $zipFileName = 'indicadors_complet_' . date('Y-m-d_H-i-s') . '.zip';
            $tempZipPath = storage_path('app/temp/' . $zipFileName);
            
            // Crear directorio temp si no existe
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            if ($zip->open($tempZipPath, \ZipArchive::CREATE) === TRUE) {
                // Añadir cada CSV al ZIP
                $csvFiles = [
                    'distribucio_parades_ubicacions.csv' => $this->generateCSVContent($this->ubicacions, [
                        'Ubicació' => 'ubicacio',
                        'Nombre de Parades' => 'total',
                        'Percentatge' => 'percentatge'
                    ]),
                    'metres_lineals_ubicacions.csv' => $this->generateCSVContent($this->ubicacionsMetres, [
                        'Ubicació' => 'ubicacio',
                        'Metres Lineals' => 'metres',
                        'Percentatge' => 'percentatge'
                    ]),
                    'metres_lineals_parades.csv' => $this->generateCSVContent($this->grups, [
                        'Metres Lineals' => 'metres_lineals',
                        'Numero de Parades' => 'total_parades',
                        '% Total Parades' => 'percent_parades',
                        'Metres Totals' => 'total_metres',
                        '% Total Metres' => 'percent_metres'
                    ]),
                    'sectors_mercat.csv' => $this->generateCSVContent($this->sectors, [
                        'Sector' => 'sector',
                        'Numero de Parades' => 'total',
                        'Percentatge' => 'percentatge'
                    ]),
                    'activitats_sectors.csv' => $this->generateCSVContent($this->activitats, [
                        'Sector' => 'sector',
                        'Activitat' => 'activitat',
                        'Numero de Parades' => 'total',
                        'Percentatge' => 'percentatge'
                    ])
                ];

                foreach ($csvFiles as $fileName => $content) {
                    $zip->addFromString($fileName, $content);
                }

                $zip->close();

                // Leer y devolver el archivo ZIP
                $zipContent = file_get_contents($tempZipPath);
                unlink($tempZipPath); // Eliminar archivo temporal

                return $zipContent;
            }
        }, 'indicadors_complet_' . date('Y-m-d_H-i-s') . '.zip', [
            'Content-Type' => 'application/zip',
        ]);
    }

    private function generateCSV($data, $filename, $headers)
    {
        return response()->streamDownload(function () use ($data, $headers) {
            $handle = fopen('php://output', 'w');
            
            // Escribir encabezados
            fputcsv($handle, array_keys($headers), ';');
            
            // Escribir datos
            foreach ($data as $row) {
                $csvRow = [];
                foreach ($headers as $header => $field) {
                    $value = $row->{$field};
                    if (is_numeric($value) && strpos($field, 'percent') !== false) {
                        $value = number_format($value, 2) . '%';
                    } elseif (is_numeric($value) && strpos($field, 'metres') !== false) {
                        $value = number_format($value, 2);
                    }
                    $csvRow[] = $value;
                }
                fputcsv($handle, $csvRow, ';');
            }
            
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function generateCSVContent($data, $headers)
    {
        $content = '';
        
        // Encabezados
        $content .= implode(';', array_keys($headers)) . "\n";
        
        // Datos
        foreach ($data as $row) {
            $csvRow = [];
            foreach ($headers as $header => $field) {
                $value = $row->{$field};
                if (is_numeric($value) && strpos($field, 'percent') !== false) {
                    $value = number_format($value, 2) . '%';
                } elseif (is_numeric($value) && strpos($field, 'metres') !== false) {
                    $value = number_format($value, 2);
                }
                $csvRow[] = $value;
            }
            $content .= implode(';', $csvRow) . "\n";
        }
        
        return $content;
    }
}