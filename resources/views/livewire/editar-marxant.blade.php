<div class="bg-white p-8 rounded-lg mt-8 shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-semibold text-center mb-6">Modificar Marxant</h2>
    
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif
    
    <form wire:submit.prevent="save">
        <!-- Nombre -->
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom:<span class="text-red-500">*</label>
            <input type="text" id="nom" wire:model="nom" maxlength="100" required 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- NIF -->
        <div class="mb-4">
            <label for="nif" class="block text-sm font-medium text-gray-700">NIF:<span class="text-red-500">*</label>
            <input type="text" id="nif" wire:model="nif" maxlength="15" required 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('nif') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Fecha de nacimiento -->
        <div class="mb-4">
            <label for="data_naixement" class="block text-sm font-medium text-gray-700">Data de Naixement:<span class="text-red-500">*</label>
            <input type="date" id="data_naixement" wire:model="data_naixement" required 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('data_naixement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Teléfono fijo -->
        <div class="mb-4">
            <label for="telefon_fix" class="block text-sm font-medium text-gray-700">Telèfon Fix:</label>
            <input type="text" id="telefon_fix" wire:model="telefon_fix" maxlength="20" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('telefon_fix') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Teléfono móvil -->
        <div class="mb-4">
            <label for="telefon_mobil" class="block text-sm font-medium text-gray-700">Telèfon Mòbil:</label>
            <input type="text" id="telefon_mobil" wire:model="telefon_mobil" maxlength="20" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('telefon_mobil') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Correo electrónico -->
        <div class="mb-4">
            <label for="correu" class="block text-sm font-medium text-gray-700">Correu Electrònic:</label>
            <input type="email" id="correu" wire:model="correu" maxlength="100" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('correu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Dirección -->
        <div class="mb-4">
            <label for="adreca" class="block text-sm font-medium text-gray-700">Adreça:</label>
            <input type="text" id="adreca" wire:model="adreca" maxlength="150" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('adreca') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Código postal -->
        <div class="mb-4">
            <label for="codi_postal" class="block text-sm font-medium text-gray-700">Codi Postal:</label>
            <input type="text" id="codi_postal" wire:model="codi_postal" maxlength="10" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('codi_postal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Régimen de seguridad social -->
        <div class="mb-4">
            <label for="regim_ss" class="block text-sm font-medium text-gray-700">Règim de Seguretat Social:</label>
            <select id="regim_ss" wire:model="regim_ss" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="Altres">Altres</option>
                <option value="Autònom">Autònom</option>
                <option value="Cooperativista">Cooperativista</option>
                <option value="No Consta">No Consta</option>
            </select>
            @error('regim_ss') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Seguro -->
        <div class="mb-4">
            <label for="asseguranca" class="block text-sm font-medium text-gray-700">Assegurança:</label>
            <input type="text" id="asseguranca" wire:model="asseguranca" maxlength="100" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('asseguranca') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Observaciones -->
        <div class="mb-4">
            <label for="observacions" class="block text-sm font-medium text-gray-700">Observacions:</label>
            <textarea id="observacions" wire:model="observacions" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            @error('observacions') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Mostrar imágenes existentes -->
        @if (!empty($imatges_existents))
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Imatges Existents:</label>
        <div class="mt-2 grid grid-cols-3 gap-2">
            @foreach($imatges_existents as $index => $imatge)
                <div class="relative p-2 bg-white border border-gray-200 rounded-xl">
                    <img src="{{ Storage::url($imatge['path']) }}" class="mb-2 w-full h-32 object-cover rounded-lg">
                    <button type="button" wire:click="removeExistingImage({{ $index }})" 
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
    </div>
@endif

        
        <!-- Imágenes nuevas -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Afegir Imatges:</label>
            <input type="file" wire:model="imatges" accept="image/*" multiple 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <div wire:loading wire:target="imatges" class="mt-2 text-sm text-blue-600">Carregant...</div>
            @error('imatges.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            
            <!-- Preview para imágenes -->
            @if ($imatges)
                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach($imatges as $index => $image)
                        <div class="relative p-2 bg-white border border-gray-200 rounded-xl">
                            <img src="{{ $image->temporaryUrl() }}" class="mb-2 w-full h-32 object-cover rounded-lg">
                            <button type="button" wire:click="removeImage({{ $index }})" 
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
        
        @if (!empty($fitxers_existents))
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Fitxers Existents:</label>
        <div class="mt-2 space-y-2">
            @foreach($fitxers_existents as $index => $fitxer)
                <div class="relative p-2 bg-white border border-gray-200 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <a href="{{ Storage::url($fitxer['path']) }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                                {{ $fitxer['nom'] ?? 'Fitxer' }}
                            </a>
                        </div>
                        <button type="button" wire:click="removeExistingFile({{ $index }})" 
                            class="text-gray-500 hover:text-red-600 focus:outline-none">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

        
        <!-- Ficheros adjuntos nuevos -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Afegir Fitxers:</label>
            <input type="file" wire:model="fitxers_adjuntats" multiple 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <div wire:loading wire:target="fitxers_adjuntats" class="mt-2 text-sm text-blue-600">Carregant...</div>
            @error('fitxers_adjuntats.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            
            <!-- Preview para ficheros -->
            @if ($fitxers_adjuntats)
                <div class="mt-2 space-y-2">
                    @foreach($fitxers_adjuntats as $index => $file)
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
                            <button type="button" wire:click="removeFile({{ $index }})" 
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

        <!-- Datos públicos -->
        <div class="mb-4">
            <label for="dades_publiques" class="block text-sm font-medium text-gray-700">Dades Públiques:<span class="text-red-500">*</label>
            <select id="dades_publiques" wire:model="dades_publiques" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="Si">Sí</option>
                <option value="No">No</option>
            </select>
            @error('dades_publiques') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Botón de guardar -->
        <div class="flex justify-center mt-6">
            <button type="submit" 
                class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Guardar
            </button>
        </div>
    </form>
</div>