<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Estadísticas | Refrandle</title>
		<link href="https://fonts.googleapis.com/css2?family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="../css/main_styles.css?v=20250707">
		<link rel="stylesheet" href="../css/stats_styles.css">
		<link rel="icon" href="../multimedia/imagenes/favicon.png" type="image/x-icon">
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script src="../javascript/stats.js"></script>
		<script src="../javascript/events.js?v=2.1" defer></script>
	</head>

	<body>
		<a href="#main-content" class="visually-hidden-focusable">Saltar al contenido principal</a>
		<header class="top-titulo">
			<button type="button" id="dropdown-nav" onclick="openNav()" aria-label="Abrir menú" aria-expanded="false">&#x2630;</button>
			<a id="enlace-titulo" href="../">
				<img src="../multimedia/imagenes/favicon.png" alt="Icono de Refrandle" width="65" height="65">
				<h1>Refrandle</h1>
			</a>
			<nav id="nav-menu">
				<article class="enlaces-nav"><a href="../" aria-label="Inicio"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg><span class="nombre-icono" style="display:none;">Inicio</span></a></article>

				<article class="enlaces-nav"><a href="../menu/ayuda.php" aria-label="Ayuda"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help-hexagon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 16v.01" /><path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg><span class="nombre-icono" style="display:none;">Ayuda</span></a></article>

				<article class="enlaces-nav"><a href="../menu/contacto.php" aria-label="Contacto"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg><span class="nombre-icono" style="display:none;">Contacto</span></a></article>
			</nav>
		</header>

		<main id="main-content" class="container">
			<article class="stats-selector">
				<label for="gameMode" class="visually-hidden">Modo de juego</label>
				<select id="gameMode" name="gameMode">
					<option value="5">Al mejor de 5</option>
					<option value="10">Al mejor de 10</option>
					<option value="20">Al mejor de 20</option>
					<option value="100">Supervivencia</option>
				</select>
			</article>

			<h1>Estadísticas</h1>
			<article class="stats-header">
				<h2><span id="gamesNumber"></span>Juegos jugados</h2>
				<h2><span id="bestScore"></span>Mejor puntuación</h2>
				<h2><span id="percentile"></span>Percentil</h2>
			</article>
		
			<h2>Puntuaciones globales</h2>
			<article class="container-canvas">	
				<canvas id="lineChart" role="img" aria-label="Gráfico de línea mostrando la evolución de puntuaciones globales y tu puntuación máxima"></canvas>
			</article>

			<h2>Resultados recientes</h2>
			<article class="container-canvas">
				<canvas id="barChart" role="img" aria-label="Gráfico de barras mostrando la puntuación conseguida en tus últimas quince partidas"></canvas>
			</article>
		</main>

		<footer class="footer-container" style="display:none;">
			<p></p>
		</footer>

		<div class="scroll-buffer">contacto@refrandle.es</div>
	</body>
</html>