import './bootstrap';
import 'preline'
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


 // Script para validar la edad en el cliente
 function validateAge(input) {
    const selectedDate = new Date(input.value);
    const today = new Date();
    
    // Calcular la fecha mínima (18 años atrás desde hoy)
    const minDate = new Date();
    minDate.setFullYear(today.getFullYear() - 18);
    
    // Validar si la fecha seleccionada es posterior a la fecha mínima permitida
    if (selectedDate > minDate) {
        alert('Has de tenir almenys 18 anys.');
        input.value = '';
        
        // Para Livewire, necesitamos actualizar el modelo cuando limpiamos el input
        if (typeof window.Livewire !== 'undefined') {
            window.Livewire.emit('set', 'data_naixement', '');
        }
    }
}

// Establecer la fecha máxima al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('data_naixement');
    if (dateInput) {
        // Formato YYYY-MM-DD para el atributo max
        const maxDate = new Date();
        maxDate.setFullYear(maxDate.getFullYear() - 18);
        
        const month = String(maxDate.getMonth() + 1).padStart(2, '0');
        const day = String(maxDate.getDate()).padStart(2, '0');
        const formattedDate = `${maxDate.getFullYear()}-${month}-${day}`;
        
        dateInput.setAttribute('max', formattedDate);
    }
});