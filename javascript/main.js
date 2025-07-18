document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');
    const footerContainer = document.getElementById('footer-container');
    const startBtn = document.getElementById('start-btn');
    const startGameBtn = document.getElementById('start-game-btn');
    const userInputElement = document.getElementById('answer-input');
    const submitBtn = document.getElementById('submit-btn');
    const resultElement = document.getElementById('result');
    const pointsElement = document.getElementById('points');
    const gameOverScreen = document.getElementById('game-over');
    const gameOverButtons = document.getElementById('game-over-buttons');
    const finalScoreElement = document.getElementById('final-score');
    const puntuacionDisplay = document.getElementById("puntuacion-display");
    const scrollBuffer = document.querySelector('.scroll-buffer');
    const estilosRoot = getComputedStyle(document.documentElement);
    const aciertoSound = new Audio('multimedia/sonidos/resultado-acierto.wav');
    const semiSound = new Audio('multimedia/sonidos/resultado-semi-acierto.wav');
    const falloSound = new Audio('multimedia/sonidos/resultado-fallo.wav');
    const finalSound = new Audio('multimedia/sonidos/game-over.wav');
    let currentFirstPart = "";
    let currentSecondVariants = [];
    let points = 0;
    let modo = 0;
    let num = 0;
    let timeTimeout = 2600;
    let refranesRepetidos = [];
    let isWaiting = false;

    // Inicializamos el localStorage
    const allScores = JSON.parse(localStorage.getItem('allScores') || JSON.stringify({
        5: [],          // Al mejor de 5
        10: [],         // Al mejor de 10
        20: [],         // Al mejor de 20
        100: []         // Superviviencia (100)
    }));

    // Precargamos los efectos de sonido
    aciertoSound.preload = 'auto';
    aciertoSound.volume = 0.1;
    semiSound.preload = 'auto';
    semiSound.volume = 0.15;
    falloSound.preload = 'auto';
    falloSound.volume = 0.1;
    finalSound.preload = 'auto';
    finalSound.volume = 0.05;

    // Event listener para el botón de seleccionar modo
    startBtn.addEventListener('click', function() {
        container.classList.add('ancho-1');
        startBtn.style.display = 'none';
        document.getElementById('mode-selection').style.display = 'grid';   // Mostrar selección de modo
        startGameBtn.style.display = 'inline-block';
        document.getElementById('titulo-container').innerText = 'Modos';
        document.getElementById('score').innerText = 'Elige el número de refranes al que quieres enfrentarte';
        footerContainer.style.setProperty('display', 'none', 'important');

        // Definimos handler de resize para esta vista
        resizeHandler = function() {
            const anchoPantalla = window.innerWidth;

            if (anchoPantalla <= TABLET_WIDTH) {
                scrollBuffer.style.display = 'block';
            } else {
                scrollBuffer.style.display = 'none';
            }
        };

        // Llamada inicial
        resizeHandler();

        // Listener
        window.addEventListener('resize', resizeHandler);
    });

    // Event listener para el botón de iniciar juego
    startGameBtn.addEventListener('click', function() {
        let modoBtn = document.querySelector('input[name="mode"]:checked');

        if (modoBtn && modoBtn.value) {
            modo = parseInt(modoBtn.value);
            container.classList.add('intensidad-1');
            container.classList.add('animacion-1');
            document.getElementById('mode-selection').style.display = 'none';
            startGameBtn.style.display = 'none';
            document.getElementById('game-container').style.display = 'block';
            document.getElementById('score').style.display = 'none';
            document.getElementById('titulo-container').innerText = 'Puntos: ' + points.toString();
            startGame();
        } else {
            alert("Por favor, selecciona un modo antes de iniciar el juego.");
        }
    });

    // Detectar botón para enviar la respuesta
    submitBtn.addEventListener('click', function() {
        if (!isWaiting) {   // Evitar envíos múltiples
            const userInput = userInputElement.value.trim();
            comprobarRespuesta(userInput);
        }
    });

    // Detectar tecla Enter para enviar la respuesta
    userInputElement.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' && !isWaiting) {
            const userInput = userInputElement.value.trim();
            comprobarRespuesta(userInput);
        }
    });

    // Función para comprobar la respuesta del usuario
    function comprobarRespuesta(respuestaUsuario) {
        isWaiting = true;
        submitBtn.disabled = true;

        // Normalización robusta
        const normalizar = (str) => {
            return str.toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "")  // Eliminar acentos
                .replace(/[.,;¿?!¡'"]/g, '')                       // Eliminar puntuación
                .replace(/\s+/g, ' ').trim();                      // Normalizar espacios
        };

        const userInput = normalizar(respuestaUsuario);
        
        // Verificamos coincidencia completa con cualquier variante
        const match = currentSecondVariants.some(variant => 
            normalizar(variant) === userInput
        );

        // Usamos la primera variante para puntuación parcial y mensajes
        const firstVariant = currentSecondVariants[0];
        const palabrasReferencia = normalizar(firstVariant).split(" ");
        const palabrasUsuario = userInput.split(" ");
        
        let palabrasCoincidentes = 0;
        palabrasUsuario.forEach(palabra => {
            if (palabrasReferencia.includes(palabra)) {
                palabrasCoincidentes++;
            }
        });

        // Manejo de resultados
        if (match) {
            timeTimeout = 1000;
            aciertoSound.play();
            resultElement.innerHTML = "¡Respuesta correcta!";
            resultElement.style.color = estilosRoot.getPropertyValue('--color-resultado');
            points += 10;
            mostrarAnimacionPuntuacion("+10", "34%");
        } else if (palabrasCoincidentes > 0) {
            timeTimeout = 2600;
            semiSound.play();
            resultElement.innerHTML = `Respuesta parcial. Posible respuesta: <br>"${firstVariant}"`;
            resultElement.style.color = estilosRoot.getPropertyValue('--color-resultado-parcial');
            const puntos = Math.round(10 / palabrasReferencia.length * palabrasCoincidentes);
            points += puntos;
            mostrarAnimacionPuntuacion(`+${puntos}`, "39%");
        } else {
            timeTimeout = 2600;
            falloSound.play();
            resultElement.innerHTML = `Respuesta incorrecta. Posible respuesta: <br>"${firstVariant}"`;
            resultElement.style.color = estilosRoot.getPropertyValue('--color-resultado-incorrecto');
            if(modo === 100){
                finalSound.play();
                setTimeout(mostrarPantallaFinal, timeTimeout);
            }
        }
        
        // Actualizamos la puntuacion
        document.getElementById('titulo-container').innerHTML = 
        "Puntos: " + points.toString() + "<span id='puntos-posibles'>/" + (num*10).toString() + "</span>";

        if(num == modo){
            finalSound.play();
            setTimeout(mostrarPantallaFinal, timeTimeout);
        }
        else{
            setTimeout(() => {
                isWaiting = false;              // Reiniciar la bandera de espera
                submitBtn.disabled = false;     // Habilitar el botón "Enviar"
                cargarNuevoRefran();
            }, timeTimeout);
        }
    }

    // Función para mostrar la animación de puntuación
    function mostrarAnimacionPuntuacion(texto, posicion = "34%") {
        puntuacionDisplay.textContent = texto;
        puntuacionDisplay.style.right = posicion;
        
        // Reiniciamos la animación
        puntuacionDisplay.style.display = "block";
        void puntuacionDisplay.offsetWidth;
        
        // Manejamos el final de la animación
        const handleAnimationEnd = () => {
            puntuacionDisplay.style.display = "none";
            puntuacionDisplay.removeEventListener('animationend', handleAnimationEnd);
        };
        
        puntuacionDisplay.addEventListener('animationend', handleAnimationEnd);
    }

    // Función que carga el siguiente refrán
    function cargarNuevoRefran() {
        num++;

        fetch('php/obtener_refran.php')
        .then(response => response.json())
        .then(data => {
            const identificador = data.primera_parte + "|" + data.variantes[0]; // Usamos la primera variante para identificador único
            
            if (!refranesRepetidos.includes(identificador)) {
                refranesRepetidos.push(identificador);
                currentFirstPart = data.primera_parte;
                currentSecondVariants = data.variantes;  // Todas las variantes
                
                document.getElementById('first-part').textContent = currentFirstPart;
                resultElement.textContent = "";
                userInputElement.value = "";
            }
            else if(num < modo){
                cargarNuevoRefran();
            }
            else{
                finalSound.play();
                setTimeout(mostrarPantallaFinal, timeTimeout);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Función que comienza la partida
    function startGame() {
        refranesRepetidos = [];
        num = 0;
        points = 0;
        pointsElement.textContent = points;
        cargarNuevoRefran();
    }

    // Función que muestra la pantalla final
    function mostrarPantallaFinal() {
        document.getElementById('game-container').style.display = 'none';
        document.getElementById('score').style.display = 'none';
        document.getElementById('titulo-container').innerText = 'Juego finalizado';
        gameOverScreen.style.display = 'block';

        // Si el modo es Supervivencia no mostramos cual es el maximo de puntos posibles
        finalScoreElement.textContent = (modo === 100) ? points : points + "/" + (modo * 10);
        
        // Guardamos la puntuación en el localStorage
        allScores[modo].push(points);
        localStorage.setItem('allScores', JSON.stringify(allScores));
        console.log(points);

        // Guardamos la puntuación en el servidor
        submitScoreToServer(modo, points);

        // Controlador de eventos para recargar la página
        const botonRecargar = document.createElement("button");
        botonRecargar.textContent = "Volver a jugar";
        botonRecargar.addEventListener("click", function() {
            location.reload();
        });

        // Botón para ver las estadísticas
        const botonStats = document.createElement("button");
        botonStats.textContent = "Ver estadísticas";
        botonStats.addEventListener("click", function() {
            location.href = "menu/estadisticas.php";
        });

        // Agregamos los botones al cuerpo del documento
        gameOverButtons.appendChild(botonRecargar);
        gameOverButtons.appendChild(botonStats);
    }
});


// Funcion asincrona para enviar la puntuacion al servidor
async function submitScoreToServer(mode, score) {
    try {
        await fetch('php/subir_puntuacion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                modo: mode,
                puntuacion: score
            })
        });
    } catch (error) {
        console.error('Error subiendo puntuacion', error);
    }
}