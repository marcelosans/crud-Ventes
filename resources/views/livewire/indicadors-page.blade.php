<div class="bg-gradient-to-br from-slate-50 to-blue-50 p-8 rounded-2xl mt-8 shadow-2xl w-full max-w-6xl border border-slate-200">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Indicadors</h1>
        
        <!-- Botón de descarga general -->
        <div class="mt-4">
            <button wire:click="downloadAllCSV" 
                    class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 flex items-center space-x-2 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Descargar Tots els CSV</span>
            </button>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-emerald-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Parades Actives</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalActives }}</p>
                </div>
                <div class="p-3 bg-emerald-100 rounded-full">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Parades</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalParades }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-amber-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Metres Lineals Actius</p>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalMetresLinealsActives, 2, ',', '.') }}<span class="text-lg font-normal text-slate-600"> m</span></p>
                </div>
                <div class="p-3 bg-amber-100 rounded-full">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Metres Lineals</p>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalMetresLineals, 2, ',', '.') }}<span class="text-lg font-normal text-slate-600"> m</span></p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-red-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Marxants Actius</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalMarxantActiu }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="space-y-8">

        <!-- Metres Lineals per Ubicació -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-pink-600 to-pink-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Metres Lineals per Ubicació
                </h2>
                <button wire:click="downloadUbicacionsMetresCSV" 
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-black px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>CSV</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Ubicació</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metres Lineals</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Percentatge</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @php
                            $totalMetresUbicacions = $ubicacionsMetres->sum('metres');
                        @endphp
                        @foreach ($ubicacionsMetres as $ubicacio)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $ubicacio->ubicacio }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ number_format($ubicacio->metres, 2) }} m</td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $ubicacio->percentatge }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-slate-100 font-bold">
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">TOTAL</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">{{ number_format($totalMetresUbicacions, 2) }} m</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-800">
                                    100%
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Distribució de parades segons ubicacions -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Distribucions de parades segons ubicacions
                </h2>
                <button wire:click="downloadUbicacionsCSV" 
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-black px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>CSV</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Ubicació</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nombre de Parades</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Percentatge</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @php
                            $totalParadesUbicacions = $ubicacions->sum('total');
                        @endphp
                        @foreach ($ubicacions as $ubicacio)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $ubicacio->ubicacio }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $ubicacio->total }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $ubicacio->percentatge }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-slate-100 font-bold">
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">TOTAL</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">{{ $totalParadesUbicacions }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-800">
                                    100%
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Metres Lineals de las Parades -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Metres Lineals de las Parades
                </h2>
                <button wire:click="downloadGrupsCSV" 
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-black px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>CSV</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metres Lineals</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Numero de Parades</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">% Total Parades</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metres Totals</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">% Total Metres</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @php
                            $totalParadesGrups = $grups->sum('total_parades');
                            $totalMetresGrups = $grups->sum('total_metres');
                        @endphp
                        @foreach ($grups as $grup)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $grup->metres_lineals }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $grup->total_parades }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $grup->percent_parades }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ number_format($grup->total_metres, 2) }} m</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $grup->percent_metres }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-slate-100 font-bold">
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">TOTAL</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">{{ $totalParadesGrups }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-800">
                                    100%
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">{{ number_format($totalMetresGrups, 2) }} m</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-800">
                                    100%
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sectores Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Sectors del Mercat
                </h2>
                <button wire:click="downloadSectorsCSV" 
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-black px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>CSV</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Sector</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Numero de Parades</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Percentatge</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @php
                            $totalParadesSectors = $sectors->sum('total');
                        @endphp
                        @foreach ($sectors as $sector)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $sector->sector }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $sector->total }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $sector->percentatge }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-slate-100 font-bold">
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">TOTAL</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">{{ $totalParadesSectors }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-800">
                                    100%
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Actividades por Sector Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H6a2 2 0 00-2-2V4m8 0H8m0 0v2H6.5m1.5-2h8"></path>
                    </svg>
                    Activitat per Sectors del Mercat
                </h2>
                <button wire:click="downloadActivitatsCSV" 
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-black px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>CSV</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Sector</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Activitat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Numero de Parades</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Percentatge</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @php
                            $totalParadesActivitats = $activitats->sum('total');
                        @endphp
                        @foreach ($activitats as $activitat)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $activitat->sector }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $activitat->activitat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $activitat->total }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $activitat->percentatge }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-slate-100 font-bold">
                            <td class="px-6 py-4 text-sm font-bold text-slate-900" colspan="2">TOTAL</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">{{ $totalParadesActivitats }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-800">
                                    100%
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>