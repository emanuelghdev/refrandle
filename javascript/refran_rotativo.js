document.addEventListener('DOMContentLoaded', async function() {
    try {
        const respuesta = await fetch('php/obtener_refranes.php');
        const refranes = await respuesta.json();
        const fecha = document.querySelector('.fecha-rotativa');
        const bloque = document.querySelector('.frase-rotativa');
        if (!bloque) return;
        
        // Obtenemos el día del año
        const ahora = new Date();

        const opciones = {
            weekday: 'long',    // lunes
            day: 'numeric',     // 23
            month: 'long',      // junio
            year: 'numeric'     // 2025
        };

        const fechaFormateada = ahora.toLocaleDateString('es-ES', opciones);
        fecha.textContent = "(" + fechaFormateada + ")";

        // Calculamos el indice
        const inicioAño = new Date(ahora.getFullYear(), 0, 0);
        const dif = ahora - inicioAño;
        const unDia = 1000 * 60 * 60 * 24;
        const diaDelAño = Math.floor(dif / unDia);
        
        // Seleccionamos el refrán del día
        const indice = diaDelAño % refranes.length;
        bloque.textContent = `"${refranes[indice]}"`;
        
    } catch (error) {
        console.error('Error cargando refranes:', error);
    }
});