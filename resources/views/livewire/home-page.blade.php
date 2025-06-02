<div class="py-4 sm:py-6 mt-8">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
        <!-- Mensajes flash -->
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 sm:p-4 mb-4 text-sm sm:text-base" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-md sm:shadow-xl sm:rounded-lg p-3 sm:p-4 md:p-6">
            <!-- Barra de búsqueda y controles -->
            <div class="flex flex-col space-y-3 sm:space-y-4 md:space-y-0 md:flex-row md:justify-between md:items-center mb-4 sm:mb-6">
                <!-- Búsqueda - toma todo el ancho en móvil, 1/3 en desktop -->
                <div class="w-full md:w-1/3">
                    <label for="search" class="sr-only">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" id="search" 
                            class="block w-full pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Buscar marxants..." type="search">
                    </div>
                </div>
                
                <!-- Controles de orden y creación -->
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 items-stretch sm:items-center">
                    <!-- Selector de items por página -->
                    <div>
                        <select wire:model.live="perPage" 
                            class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                            <option value="10">10 per pàgina</option>
                            <option value="25">25 per pàgina</option>
                            <option value="50">50 per pàgina</option>
                            <option value="100">100 per pàgina</option>
                        </select>
                    </div>
                    
                    <!-- Botón de crear marxant -->
                    <div>
                        <a href="/fer-marxant" class="block w-full">
                            <button class="w-full bg-green-500 hover:bg-green-700 cursor-pointer text-white font-bold py-2 px-4 rounded text-sm">
                                Crear Marxant
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabla de marxants con scroll horizontal en dispositivos pequeños -->
            <div class="overflow-x-auto -mx-3 sm:mx-0 px-3 sm:px-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th wire:click="sortBy('nom')" 
                                class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                Nom
                                @if ($sortField === 'nom')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                    </span>
                                @endif
                            </th>
                            <th wire:click="sortBy('nif')" 
                                class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                NIF
                                @if ($sortField === 'nif')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                    </span>
                                @endif
                            </th>
                            <th wire:click="sortBy('telefon_mobil')" 
                                class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                Telèfon
                                @if ($sortField === 'telefon_mobil')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                    </span>
                                @endif
                            </th>
                            <th wire:click="sortBy('correu')" 
                                class="hidden sm:table-cell px-2 sm:px-4 md:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                Correu
                                @if ($sortField === 'correu')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                    </span>
                                @endif
                            </th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Accions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($marxants as $marxant)
                            <tr wire:key="{{ $marxant->id }}" class="hover:bg-gray-50">
                                <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm font-medium text-gray-900">{{ $marxant->nom }}</div>
                                </td>
                                <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-500">{{ $marxant->nif }}</div>
                                </td>
                                <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-500">{{ $marxant->telefon_mobil }}</div>
                                </td>
                                <td class="hidden sm:table-cell px-2 sm:px-4 md:px-6 py-2 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-500">{{ $marxant->correu }}</div>
                                </td>
                                <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 whitespace-nowrap text-right text-xs sm:text-sm font-medium">
                                    <div class="flex flex-col sm:flex-row justify-end sm:space-x-2 space-y-1 sm:space-y-0">
                                        <!-- Ver detalles -->
                                        <button wire:click="openModal({{ $marxant->id }})"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            Veure Detalls
                                        </button>
                                        
                                        <!-- Editar -->
                                        <a wire:click="updateMarxant({{$marxant->id}})"
                                           class="text-yellow-600 hover:text-yellow-800 cursor-pointer">
                                            Editar
                                        </a>
                        
                                        <!-- Eliminar -->
                                        <button wire:click="deleteMarxant({{$marxant->id}})"
                                            class="text-red-600 hover:text-red-800"
                                            wire:confirm="Segur que vols eliminar aquets marxant">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-2 sm:px-4 md:px-6 py-4 text-center text-xs sm:text-sm text-gray-500">
                                    No s'han trobat marxants
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4 text-xs sm:text-sm">
                {{ $marxants->links() }}
            </div>
        </div>
        
        <!-- Modal de detalles del marxant -->
        @if($modalOpen)
        <div class="fixed inset-0 overflow-y-auto z-50" wire:key="modal-{{ now() }}">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Fondo oscuro -->
                
              

                <div class="inline-block align-bottom bg-white z-50 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full sm:w-full max-w-lg mx-4" 
                     x-data="{}" 
                     @click.away="$wire.closeModal()" 
                     @keydown.escape.window="$wire.closeModal()">
                    <!-- Contenido del modal -->
                    <div class="bg-white px-3 sm:px-4 pt-3 sm:pt-5 pb-3 sm:pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-base sm:text-lg leading-6 font-medium text-gray-900 mb-3 sm:mb-4" id="modal-title">
                                    Detalls del Marxant
                                </h3>
                                
                                @if($selectedMarxant)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                                    <div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">Nom:</span> {{ $selectedMarxant->nom }}</p>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">NIF:</span> {{ $selectedMarxant->nif }}</p>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">Telèfon Mòbil:</span> {{ $selectedMarxant->telefon_mobil ?: 'No disponible' }}</p>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">Telèfon Fix:</span> {{ $selectedMarxant->telefon_fix ?: 'No disponible' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">Correu:</span> {{ $selectedMarxant->correu ?: 'No disponible' }}</p>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">Adreça:</span> {{ $selectedMarxant->adreca ?: 'No disponible' }}</p>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1"><span class="font-medium">Codi Postal:</span> {{ $selectedMarxant->codi_postal ?: 'No disponible' }}</p>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-4">
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">Observacions:</p>
                                    <div class="mt-1 p-2 bg-gray-50 rounded">
                                        <p class="text-xs sm:text-sm text-gray-500">{{ $selectedMarxant->observacions ?: 'No hi ha observacions disponibles' }}</p>
                                    </div>
                                </div>

                                <!-- Imágenes -->
                                @if(count($imatges) > 0)
                                <div class="mt-4 sm:mt-6">
                                    <h4 class="text-sm sm:text-md font-medium text-gray-700 mb-2">Imatges</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                                        @foreach($imatges as $index => $imatge)
                                        <div class="border rounded p-2">
                                            <div class="h-24 sm:h-32 bg-gray-100 flex items-center justify-center mb-2">
                                                <img src="{{ asset('storage/' . $imatge['path']) }}" 
                                                     alt="Imatge {{ $index + 1 }}" 
                                                     class="max-h-full max-w-full object-contain">
                                            </div>
                                            <div class="text-center">
                                                <a href="{{ asset('storage/' . $imatge['path']) }}" download
                                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ strlen($imatge['name']) > 12 ? substr($imatge['name'], 0, 12) . '...' : $imatge['name'] }}
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Ficheros -->
                                @if(count($fitxers) > 0)
                                <div class="mt-4 sm:mt-6">
                                    <h4 class="text-sm sm:text-md font-medium text-gray-700 mb-2">Fitxers adjuntats</h4>
                                    <div class="border rounded-md overflow-hidden">
                                        <ul class="divide-y divide-gray-200">
                                            @foreach($fitxers as $fitxer)
                                            <li class="px-3 sm:px-4 py-2 sm:py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                                <div class="flex items-center mb-1 sm:mb-0">
                                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="text-xs sm:text-sm text-gray-700 truncate max-w-xs">{{ $fitxer['name'] }}</span>
                                                </div>
                                                <a href="{{ asset('storage/' . $fitxer['path']) }}" download
                                                   class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 ml-6 sm:ml-0">
                                                    Descarregar
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Pie del modal con botón de cerrar -->
                    <div class="bg-gray-50 px-3 sm:px-4 py-2 sm:py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" 
                                wire:click="closeModal" 
                                class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto">
                            Tancar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>  
</div>