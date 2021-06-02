<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema para el seguimiento de alumnos tutorados en el programa de becas PRONABES</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
	<script src="Chart.js-2.9.4/dist/Chart.min.js"></script>
	<script src="Chart.js-2.9.4/samples/utils.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/css/style.css">

</head>
<body>
	<header class="header-inicio principal secun">
		<div class="contenido-header">
				<div>
					<a href="menu.php">
						<img class="img-logo" src="img/becas.jpg" alt="Logotipo becas">
					</a>
				</div>

				<div class="separar fw-300">
					<div class="datos-header">
						<p>Usuario: <?php print_r($_SESSION['user']); ?></p>
						<?php date_default_timezone_set('America/Mexico_City'); ?>
						<?php setlocale(LC_TIME, 'es_MX.UTF-8'); ?>
						<?php $fecha_actual= date('l jS \of F Y '); ?>
						<p><?php echo $fecha_actual; ?></p>
			
						<a class="boton boton-verde" href="<?php echo RUTA; ?>/closeSesion.php">Cerrar sesion</a>
					</div>
					<div class="text-center fw-400">
						<h1>Sistema para el seguimiento de alumnos tutorados en el programa de becas PRONABES</h1>
					</div>
				</div>
	
	</header>