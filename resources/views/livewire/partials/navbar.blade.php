<nav class="bg-white shadow-lg border-b border-gray-200 fixed top-0 left-0 right-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo/Marca -->
            <div class="flex-shrink-0">
                <a href="/" class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">
                    Venta
                </a>
            </div>
            
            <!-- Menu Desktop -->
            <div class="hidden md:block">
                <ul class="flex space-x-8">
                    <li>
                        <a href="/paradas" 
                           class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 hover:bg-blue-50 {{ request()->is('paradas*') ? 'text-blue-600 bg-blue-50' : '' }}"
                           wire:navigate>
                            Paradas
                        </a>
                    </li>
                    <li>
                        <a href="/" 
                           class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 hover:bg-blue-50 {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : '' }}"
                           wire:navigate>
                            Marxants
                        </a>
                    </li>
                     <li>
                        <a href="/indicadors" 
                           class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 hover:bg-blue-50 {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : '' }}"
                           wire:navigate>
                            Indicadors
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Botón Mobile Menu -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600 p-2 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="!mobileMenuOpen">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="mobileMenuOpen" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Menu Mobile -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="md:hidden bg-white border-t border-gray-200"
         style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/paradas" 
               class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md text-base font-medium transition-colors duration-200 {{ request()->is('paradas*') ? 'text-blue-600 bg-blue-50' : '' }}"
               wire:navigate
               @click="mobileMenuOpen = false">
                Paradas
            </a>
            <a href="/" 
               class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md text-base font-medium transition-colors duration-200 {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : '' }}"
               wire:navigate
               @click="mobileMenuOpen = false">
                Marxants
            </a>
        </div>
    </div>
</nav>

