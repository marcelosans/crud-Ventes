<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-semibold text-center mb-6">Afegir Parada</h2>
    
    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">
            {{ session('message') }}
        </div>
    @endif
    
    <form wire:submit.prevent="save">
        <!-- Numero -->
        <div class="mb-4">
            <label for="numero" class="block text-sm font-medium text-gray-700">Número:<span class="text-red-500">*</span></label>
            <input type="text" id="numero" wire:model="numero" maxlength="100" required 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('numero') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Marxant (Titular) -->
       <div class="mb-4">
            <label for="searchTerm" class="block text-sm font-medium text-gray-700">Marxant: <span class="text-red-500">*</span></label>
            <div class="relative">
                @if(!$selectedMarxant)
                    <input type="text" id="searchTerm" wire:model="searchTerm" wire:keyup="searchMarxant" placeholder="Cerca per nom o NIF" 
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @if(count($searchResults) > 0)
                        <div class="absolute z-10 w-full bg-white mt-1 rounded-md shadow-lg max-h-60 overflow-auto">
                            @foreach($searchResults as $marxant)
                                <div wire:click="selectMarxant({{ $marxant->id }})" class="p-2 hover:bg-gray-100 cursor-pointer">
                                    {{ $marxant->nom }} - {{ $marxant->nif }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="mt-1 flex items-center p-2 bg-blue-50 border border-blue-200 rounded-md">
                        <div class="flex-grow">
                            <span class="font-medium">{{ $selectedMarxant->nom }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $selectedMarxant->nif }}</span>
                        </div>
                        <button type="button" wire:click="clearSelectedMarxant" 
                            class="ml-2 text-red-500 hover:text-red-700 focus:outline-none">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            @error('marxant_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Data alta -->
        <div class="mb-4">
            <label for="data_alta" class="block text-sm font-medium text-gray-700">Data d'alta: <span class="text-red-500">*</span></label>
            <input type="date" id="data_alta" wire:model="data_alta" required 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('data_alta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Data renovacio -->
        <div class="mb-4">
            <label for="data_last_renovation" class="block text-sm font-medium text-gray-700">Data última renovació:</label>
            <input type="date" id="data_last_renovation" wire:model="data_last_renovation" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('data_last_renovation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Actiu -->
        <div class="mb-4">
            <label for="actiu" class="block text-sm font-medium text-gray-700">Actiu: <span class="text-red-500">*</span></label>
            <select id="actiu" wire:model="actiu" required
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="Si">Actiu</option>
                <option value="No">Inactiu</option>
            </select>
            @error('actiu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Tipus parada -->
        <div class="mb-4">
            <label for="tipus_parada" class="block text-sm font-medium text-gray-700">Tipus de parada:</label>
            <select id="tipus_parada" wire:model="tipus_parada" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value=""></option>
                <option value="Altres">Altres</option>
                <option value="Camio-Tenda">Camió-Tenda</option>
                <option value="Espai Reservat Comerç Local">Espai reservat comerc Local</option>
                <option value="Estructura Desmontable">Estructura Desmontable</option>
                <option value="Remolc">Remolc</option>
                <option value="Taula">Taula</option>
            </select>
            @error('tipus_parada') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Comerç Local -->
        <div class="mb-4">
            <label for="is_comerc_local" class="block text-sm font-medium text-gray-700">Comerç Local:</label>
            <select id="is_comerc_local" wire:model="is_comerc_local" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value=""></option>
                <option value="Si">Sí</option>
                <option value="No">No</option>
            </select>
            @error('is_comerc_local') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Sector -->
        <!-- Sector -->
            <div class="mb-4">
                <label for="sector" class="block text-sm font-medium text-gray-700">Sector: <span class="text-red-500">*</span></label>
                <select id="sector" wire:model="sector" wire:change="changeSector($event.target.value)" required
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Selecciona un sector</option>
                    <option value="Alimentació">Alimentació</option>
                    <option value="Equipament de la llar">Equipament de la llar</option>
                    <option value="Equipament de la persona">Equipament de la persona</option>
                    <option value="Lleure i cultura">Lleure i cultura</option>
                    <option value="Drogeria i Cosmetica">Drogeria i Cosmetica</option>
                    <option value="Textil i Moda">Textil i Moda</option>
                    <option value="Sense Informació">Sense Informació</option>
                </select>
                @error('sector') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

                <!-- Activitat -->
            <div class="mb-4" wire:key="activitat-{{ $sector }}">
            <label for="activitat" class="block text-sm font-medium text-gray-700">Activitat: <span class="text-red-500">*</span></label>
            <select id="activitat" wire:model="activitat" required
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Selecciona una activitat</option>
                @foreach($activitatOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                @endforeach
            </select>
            @error('activitat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Formació Alimentació -->
        <div class="mb-4">
            <label for="formacio_alimentacio" class="block text-sm font-medium text-gray-700">Disposa de formació en Alimentació:</label>
            <select id="formacio_alimentacio" wire:model="formacio_alimentacio" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value=""></option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            @error('formacio_alimentacio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Metres Lineals -->
        <div class="mb-4">
            <label for="metres_lineals" class="block text-sm font-medium text-gray-700">Metres Lineals: <span class="text-red-500">*</span></label>
            <input type="number" step="0.01" id="metres_lineals" wire:model="metres_lineals" required 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('metres_lineals') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Metres de fons -->
        <div class="mb-4">
            <label for="metres_de_fons" class="block text-sm font-medium text-gray-700">Metres de fons:</label>
            <input type="number" step="0.01" id="metres_de_fons" wire:model="metres_de_fons" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('metres_de_fons') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        <!-- Estacionament -->
        <div class="mb-4">
            <label for="estacionament" class="block text-sm font-medium text-gray-700">Estacionament: <span class="text-red-500">*</span></label>
            <select id="estacionament" wire:model="estacionament" required
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="Si">Sí</option>
                <option value="No">No</option>
            </select>
            @error('estacionament') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Imatges -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Imatges:</label>
            <input type="file" wire:model="imatges" accept="image/*" multiple 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <div wire:loading wire:target="imatges" class="mt-2 text-sm text-blue-600">Carregant...</div>
            @error('imatges.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            
            <!-- Preview para imágenes -->
            @if ($imatges)
                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach($imatges as $key => $image)
                        <div class="relative p-2 bg-white border border-gray-200 rounded-xl">
                            <img src="{{ $image->temporaryUrl() }}" class="mb-2 w-full h-32 object-cover rounded-lg">
                            <button type="button" wire:click="removeImage({{ $key }})" 
                                class="absolute top-1 right-1 text-gray-500 hover:text-red-600 focus:outline-none">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Fitxers adjuntats -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Fitxers Adjuntats:</label>
            <input type="file" wire:model="fitxers_adjuntats" multiple 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <div wire:loading wire:target="fitxers_adjuntats" class="mt-2 text-sm text-blue-600">Carregant...</div>
            @error('fitxers_adjuntats.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            
            <!-- Preview para ficheros -->
            @if ($fitxers_adjuntats)
                <div class="mt-2 space-y-2">
                    @foreach($fitxers_adjuntats as $key => $file)
                        <div class="relative p-2 bg-white border border-gray-200 rounded-xl">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="text-sm text-gray-800">{{ $file->getClientOriginalName() }}</span>
                            </div>
                            <button type="button" wire:click="removeFile({{ $key }})" 
                                class="absolute top-1 right-1 text-gray-500 hover:text-red-600 focus:outline-none">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Observacions -->
        <div class="mb-4">
            <label for="observacions" class="block text-sm font-medium text-gray-700">Observacions:</label>
            <textarea id="observacions" wire:model="observacions" rows="3" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            @error('observacions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Botón de guardar -->
        <div class="flex justify-center mt-6">
            <button type="submit" 
                class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Guardar
            </button>
        </div>
    </form>

    <div class="flex justify-center mt-6">
        <a href="/paradas">
            <button type="button" 
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Tornar
            </button>
        </a>
    </div>
</div>