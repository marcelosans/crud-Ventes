<!-- Modal para mostrar detalles del marxant -->
<div x-data="{ open: false }" 
     x-show="open" 
     x-on:open-details-modal.window="open = true" 
     x-on:click.away="open = false"
     x-on:keydown.escape.window="open = false"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-90"
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;"
     aria-modal="true" 
     role="dialog">

    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    <!-- Modal content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
            <!-- Modal header -->
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">
                    Detalls del Marxant
                </h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="px-6 py-4">
                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Nom</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['nom'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">NIF</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['nif'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Telèfon Mòbil</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['telefon_mobil'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Telèfon Fix</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['telefon_fix'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Correu</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['correu'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Adreça</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['adreca'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Ciutat</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['ciutat'] ?? 'No disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Codi Postal</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $marxantData['codi_postal'] ?? 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="bg-gray-100 px-6 py-4 border-t border-gray-200 flex justify-end">
                <button @click="open = false" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Tancar
                </button>
            </div>
        </div>
    </div>
</div>