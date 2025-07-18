<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ayuda | Refrandle</title>
		<link href="https://fonts.googleapis.com/css2?family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="../css/main_styles.css?v=20250707">
		<link rel="stylesheet" href="../css/info_styles.css">
		<link rel="icon" href="../multimedia/imagenes/favicon.png" type="image/x-icon">
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

				<article class="enlaces-nav"><a href="../menu/estadisticas.php" aria-label="Estadísticas"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar-popular"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M9 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M15 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 20h14" /></svg><span class="nombre-icono" style="display:none;">Estadísticas</span></a></article>

				<article class="enlaces-nav"><a href="../menu/contacto.php" aria-label="Contacto"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg><span class="nombre-icono" style="display:none;">Contacto</span></a></article>
			</nav>
		</header>

		<main id="main-content" class="container">
			<h1>¿Cómo se juega?</h1>

			<article class="container-info">
				<p>En <span class="nombre-resaltado">Refrandle</span> podrás poner a prueba tu sabiduría popular. Cada refrán aparecerá dividido en <strong>dos partes:</strong></p>
				<ul>
					<li><p><strong>Verás la primera mitad</strong> del refrán escrita en pantalla.</p></li>
					<li><p>Tu misión será <strong>escribir la segunda parte</strong> que corresponda en el recuadro de texto.</p></li>
				</ul>
				<img src="../multimedia/imagenes/ejemplo_animacion.png" class="efecto-blur" alt="Animación que muestra como resolver un refrán en el juego escribiendo la continuación de su primera parte">

				<h2>Modos</h2>
				<p>Elegir el reto que más se ajuste a ti es lo más importante, por eso <span class="nombre-resaltado">Refrandle</span> cuenta con cuatro modos de juego distintos a escoger:</p>
				<img src="../multimedia/imagenes/modos_capture.png" class="imagen-2" alt="Imagen de ejemplo de los modos de juego">
				<ol class="lista-personalizada">
					<li>Al mejor de 5</li>
						<p>Pon a prueba tu memoria con estos <strong>5 refranes</strong>. Los favoritos tu abuela. Los refranes que hicieron llorar a Steven Spielberg. Ideal para una partida rápida.</p>
					<li>Al mejor de 10</li>
						<p>Un reto intermedio con <strong>10 refranes</strong> para demostrar tu saber popular. Los refranes favoritos de tus refranes favoritos. Nunca antes ser pedante fue tan fácil.</p>
					<li>Al mejor de 20</li>
						<p>¿Siempre eliges el modo díficil en los videojuegos? ¿Tienes la aplicación de la RAE en el móvil? Prueba a llegar al final de estos <strong>20 refranes</strong> y conseguir la máxima puntuación.</p>
					<li>Supervivencia</li>
						<p>¡Un no parar de emociones refrantásticas! Irán apareciendo refranes <strong>uno tras otro</strong> y solo seguirás jugando <strong>mientras aciertes</strong>. En cuanto falles... se acabó la partida. Pero, ¿este modo tiene final? Si lo tiene... ¿serás capaz de llegar hasta él? ¿Podrás tú convertirte... en el <span class="nombre-resaltado">Refrandle</span>?</p>
				</ol>

				<h2>Puntuaciones</h2>
				<p>Las reglas para sumar puntos son iguales en todos los modos de juego. No tiene pérdida: <strong>cuanto más aciertes, más puntos ganarás</strong>. Aunque, ya que tiene su propia sección, no viene mal explicar con mayor profundidad los tres tipos de respuesta que se pueden sacar.</p>
				<ol class="lista-personalizada-2">
					<li>Respuesta correcta</li>
						<div class="imagen-container">
							<img src="../multimedia/imagenes/acierto_capture.png" class="imagen-2" alt="Imagen de ejemplo de un mensaje de acierto">
						</div>
						<p>Si completas <strong>correctamente toda la segunda parte</strong> del refrán, obtendrás <strong>10 puntos</strong>. Hay más de una versión correcta del mismo refrán, así que no te preocupes y escribe el refrán como lo has escuchado toda tu vida.</p>
					<li>Respuesta parcialmente correcta</li>
						<div class="imagen-container">
							<img src="../multimedia/imagenes/acierto_parcial_capture.png" class="imagen-2" alt="Imagen de ejemplo de un mensaje de acierto parcial">
						</div>
						<p>Si tu respuesta <strong>incluye solo algunas palabras</strong> de la solución completa, tu respuesta será parcialmente correcta, lo que significa que conseguirás una puntuación menor a la máxima posible. Sin embargo, que esto no te quite las ganas de tocar de oído, ya que se otorgarán puntos de manera proporcional al refrán: <strong>a más palabras acertadas de la solución, más puntos</strong>.</p>
					<li>Respuesta incorrecta</li>
						<div class="imagen-container">
							<img src="../multimedia/imagenes/fallo_capture.png" class="imagen-2" alt="Imagen de ejemplo de un mensaje de fallo en el juego">
						</div>
						<p>Si <strong>no aciertas ninguna palabra</strong> de la segunda parte del refrán, tu respuesta será incorrecta y <strong>no sumarás ningún punto</strong>. En el modo de Supervivencia esto también implicará perder de forma automática.</p>
				</ol>
			</article>
		</main>

		<footer class="footer-container" style="display:none;">
			<p></p>
		</footer>

		<div class="scroll-buffer">contacto@refrandle.es</div>
	</body>
</html>