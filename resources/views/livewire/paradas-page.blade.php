<div class="mt-8">
   

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 md:mb-0">
                            {{ __('Gestió de Parades') }}
                        </h2>
                        <div>
                            <button wire:click="createParada" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Nova Parada
                            </button>
                        </div>
                    </div>

                    <!-- Filtros y búsqueda -->
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                        <div class="col-span-1">
                            <label for="search" class="block text-sm font-medium text-gray-700">Cerca</label>
                            <input wire:model.live.debounce.300ms="search" type="text" id="search" placeholder="Número o marxant..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="col-span-1">
                            <label for="sectorFilter" class="block text-sm font-medium text-gray-700">Sector</label>
                            <select wire:model.live="sectorFilter" id="sectorFilter" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Tots els sectors</option>
                                @foreach($sectores as $sector)
                                    <option value="{{ $sector }}">{{ $sector }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label for="activitatFilter" class="block text-sm font-medium text-gray-700">Activitat</label>
                            <select wire:model.live="activitatFilter" id="activitatFilter" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Totes les activitats</option>
                                @foreach($actividades as $activitat)
                                    <option value="{{ $activitat }}">{{ $activitat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label for="actiuFilter" class="block text-sm font-medium text-gray-700">Estat</label>
                            <select wire:model.live="actiuFilter" id="actiuFilter" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Tots</option>
                                <option value="Si">Actiu</option>
                                <option value="No">Inactives</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label for="perPage" class="block text-sm font-medium text-gray-700">Per pàgina</label>
                            <select wire:model.live="perPage" id="perPage" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <button wire:click="resetFilters" class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-medium text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reiniciar filtres
                        </button>
                    </div>

                    <!-- Información de resultados -->
                    <div class="mb-4 text-sm text-gray-600">
                        Mostrant {{ $paradas->count() }} de {{ $paradas->total() }} resultats
                        @if($search || $sectorFilter || $activitatFilter || $actiuFilter !== '')
                            <span class="ml-2 text-blue-600">(filtrat)</span>
                        @endif
                    </div>

                    <!-- Tabla de paradas -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('numero')">
                                        <div class="flex items-center">
                                            Número
                                            @if($sortField === 'numero')
                                                @if($sortDirection === 'asc')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                @endif
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Marxant
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('sector')">
                                        <div class="flex items-center">
                                            Sector
                                            @if($sortField === 'sector')
                                                @if($sortDirection === 'asc')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                @endif
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('activitat')">
                                        <div class="flex items-center">
                                            Activitat
                                            @if($sortField === 'activitat')
                                                @if($sortDirection === 'asc')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                @endif
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('actiu')">
                                        <div class="flex items-center">
                                            Estat
                                            @if($sortField === 'actiu')
                                                @if($sortDirection === 'asc')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                @endif
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Accions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($paradas as $parada)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $parada->numero }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $parada->marxant->nom ?? 'Sense marxant' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $parada->sector }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $parada->activitat }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($parada->actiu === 'Si')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Activa
                                                </span>
                                            @elseif($parada->actiu === 'No')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Inactiva
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button wire:click="openModal({{ $parada->id }})" class="text-blue-600 hover:text-blue-900 mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button wire:click="updateParada({{ $parada->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button wire:click="deleteParada({{ $parada->id }})" class="text-red-600 hover:text-red-900"   wire:confirm="Vols eliminar aquesta parada?">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            @if($search || $sectorFilter || $activitatFilter || $actiuFilter !== '')
                                                No s'han trobat parades amb els filtres aplicats
                                            @else
                                                No s'han trobat parades
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $paradas->links() }}
                    </div>

                    <!-- Mensajes de sesión -->
                    @if(session()->has('message'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4" role="alert">
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de detalle de parada -->
    @if($modalOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Detalls de la Parada
                                </h3>
                                <div class="mt-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Número</p>
                                            <p class="text-sm text-gray-900">{{ $selectedParada->numero }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Sector</p>
                                            <p class="text-sm text-gray-900">{{ $selectedParada->sector }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Activitat</p>
                                            <p class="text-sm text-gray-900">{{ $selectedParada->activitat }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Estat</p>
                                            <p class="text-sm text-gray-900">
                                                @if($selectedParada->actiu)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Activa
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Inactiva
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-500">Marxant</p>
                                        @if($selectedParada->marxant)
                                            <p class="text-sm text-gray-900">{{ $selectedParada->marxant->nom }} ({{ $selectedParada->marxant->nif }})</p>
                                            <p class="text-sm text-gray-500">{{ $selectedParada->marxant->correu }}</p>
                                            <p class="text-sm text-gray-500">{{ $selectedParada->marxant->telefon }}</p>
                                        @else
                                            <p class="text-sm text-gray-500">Sense marxant assignat</p>
                                        @endif
                                    </div>

                                    @if($selectedParada->observacions)
                                        <div class="mt-4">
                                            <p class="text-sm font-medium text-gray-500">Observacions</p>
                                            <p class="text-sm text-gray-900">{{ $selectedParada->observacions }}</p>
                                        </div>
                                    @endif

                                    @if(count($imatges) > 0)
                                        <div class="mt-4">
                                            <p class="text-sm font-medium text-gray-500 mb-2">Imatges</p>
                                            <div class="grid grid-cols-2 gap-2">
                                                @foreach($imatges as $imatge)
                                                    <div class="relative">
                                                        <a href="{{ asset($imatge['path']) }}" target="_blank">
                                                            <img src="{{ asset($imatge['path']) }}" alt="{{ $imatge['name'] }}" class="w-full h-24 object-cover rounded">
                                                        </a>
                                                        <p class="text-xs text-gray-500 truncate">{{ $imatge['name'] }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if(count($fitxers) > 0)
                                        <div class="mt-4">
                                            <p class="text-sm font-medium text-gray-500 mb-2">Fitxers adjunts</p>
                                            <ul class="list-disc pl-5">
                                                @foreach($fitxers as $fitxer)
                                                    <li>
                                                        <a href="{{$fitxer['path'] }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                                                            {{ $fitxer['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="updateParada({{ $selectedParada->id }})" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Editar
                        </button>
                        <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Tancar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>