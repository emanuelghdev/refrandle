<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="El juego online definitivo de adivinar refranes en español. Termina los refranes de toda la vida, pon a prueba tu ingenio, compite con amigos y descubre nuevos dichos populares.">
		<title>Refrandle - Juego de Adivinar Refranes en Español</title>
		<link rel="canonical" href="https://refrandle.es/">
		<link href="https://fonts.googleapis.com/css2?family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/main_styles.css?v=20250707">
		<link rel="icon" href="multimedia/imagenes/favicon.png" type="image/x-icon">
		<script src="javascript/main.js?v=1.5" defer></script>
		<script src="javascript/events.js?v=2.1" defer ></script>
		<script src="javascript/refran_rotativo.js" defer></script>
	</head>

	<body>
		<a href="#main-content" class="visually-hidden-focusable">Saltar al contenido principal</a>
		<header class="top-titulo">
			<button type="button" id="dropdown-nav" onclick="openNav()" aria-label="Abrir menú" aria-expanded="false">&#x2630;</button>
			<a id="enlace-titulo" href=".">
				<img src="multimedia/imagenes/favicon.png" alt="Icono de Refrandle" width="65" height="65">
				<h1>Refrandle</h1>
			</a>
			<nav id="nav-menu">
				<article class="enlaces-nav"><a href="menu/ayuda.php" aria-label="Ayuda"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help-hexagon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 16v.01" /><path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg><span class="nombre-icono" style="display:none;">Ayuda</span></a></article>

				<article class="enlaces-nav"><a href="menu/estadisticas.php" aria-label="Estadísticas"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar-popular"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M9 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M15 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 20h14" /></svg><span class="nombre-icono" style="display:none;">Estadísticas</span></a></article>

				<article class="enlaces-nav"><a href="menu/contacto.php" aria-label="Contacto"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg><span class="nombre-icono" style="display:none;">Contacto</span></a></article>
			</nav>
		</header>

		<main id="main-content" class="container" tabindex="-1">
			<span id="puntuacion-display"></span>
			<h1 id="titulo-container" role="status" aria-live="polite">Juega ahora <span id="icono-easteregg">*</span></h1>
			<p id="score">Adivina la segunda parte de estos refranes <span id="points"></span></p>
			<button id="start-btn">Seleccionar modo</button> 

			<fieldset id="mode-selection" style="display:none;">
				<legend class="visually-hidden">Seleccionar modo de juego</legend>
				<article class="seleccion">
					<input type="radio" id="mode-5" name="mode" value="5" class="radio-input" required aria-required="true" />
					<label for="mode-5" class="radio-label">
						<div class="radio-content">
							<h2 class="radio-title">Al mejor de 5</h2>
							<h3 class="radio-description"></h3>
						</div>
						<svg class="radio-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
						</svg>
					</label>
				</article>
				<article class="seleccion">
					<input type="radio" id="mode-10" name="mode" value="10" class="radio-input" />
					<label for="mode-10" class="radio-label">
						<div class="radio-content">
							<h2 class="radio-title">Al mejor de 10</h2>
							<h3 class="radio-description"></h3>
						</div>
						<svg class="radio-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
						</svg>
					</label>
				</article>
				<article class="seleccion">
					<input type="radio" id="mode-20" name="mode" value="20" class="radio-input" />
					<label for="mode-20" class="radio-label">
						<div class="radio-content">
							<h2 class="radio-title">Al mejor de 20</h2>
							<h3 class="radio-description"></h3>
						</div>
						<svg class="radio-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
					</label>
				</article>
				<article class="seleccion">
					<input type="radio" id="mode-supervivencia" name="mode" value="100" class="radio-input" />
					<label for="mode-supervivencia" class="radio-label">
						<div class="radio-content">
							<h2 class="radio-title">Modo supervivencia</h2>
							<h3 class="radio-description"></h3>
						</div>
						<svg class="radio-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
					</label>
				</article>	
			</fieldset>

			<button id="start-game-btn" style="display:none;">Iniciar</button> 
			<article id="game-container" style="display:none;">
				<p id="first-part" role="status" aria-live="polite"></p>
				<div id="answer-container">
					<label for="answer-input" class="visually-hidden">Segunda parte del refrán</label>
					<input type="text" id="answer-input" aria-required="true">
					<button id="submit-btn">Enviar</button>
				</div>
				<p id="result" aria-live="assertive"></p>
			</article>

			<article id="game-over" role="status" aria-live="polite" style="display:none;"> 
				<h2>Tu puntuación final es: <span id="final-score"></span></h2>
				<article id="game-over-buttons">
				</article>
			</article>
		</main>

		<footer id="footer-container">
			<p>Refrán del día <span class="fecha-rotativa"></span></p>
			<blockquote class="frase-rotativa" aria-live="polite"></blockquote>
		</footer>

		<div class="scroll-buffer" class="visually-hidden" style="display:none;">contacto@refrandle.es</div>
	</body>
</html>