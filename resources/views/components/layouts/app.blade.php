<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>{{ $title ?? 'Marxants' }}</title>
        
        <!-- Solo use una forma de cargar los scripts: Vite o Mix, no ambos -->
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        
        <!-- Carga Alpine.js antes de los scripts de Livewire -->
        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/preline@2.0.0/dist/preline.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
        <script src="node_modules/@material-tailwind/html@latest/scripts/dialog.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
        <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>

        @livewireStyles
    </head>
    <body class="bg-gray-100 py-10 flex justify-center">
         @livewire('partials.navbar')
        {{ $slot }}
        
       
        @livewireScripts
        @livewire('wire-elements-modal')
        <script src="./assets/vendor/preline/dist/preline.js"></script>
       
        
       
    </body>
</html>