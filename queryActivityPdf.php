<?php session_start();
	require 'admin/configuration.php';
	require 'admin/function.php';
//comprobar el inicio de sesion
	if (isset($_SESSION['user'])) {

		$conexion= conexion($bdConfig);

		if (!$conexion) {
				echo "no se conecto<br>";
		}else{
				//echo "succesfull!!<br>";
		}
		$mensaje='';

		
		// llega de la pagina queryActivity y depende del que se seleccione
		$matricula=$_POST['matricula'];
		//echo $matricula;
		if(empty($matricula)){
			
			header('Location: queryActivity.php');
		}


		// consulta para obtener el trimestre de inicio del alumno
		$statement= $conexion->prepare('
		SELECT   nombre,primerApellido,segundoApellido FROM  alumnoTutor WHERE matricula=:matrReg');
	    $statement->execute(array(
			':matrReg'=>$matricula
		));
		
		$resultadoOne=$statement->fetch();
		//var_dump($resultadoOne);
		//echo $resultadoOne['trimestreingreso'];

		$statement= $conexion->prepare('
		SELECT   descripcion, actividades.nombreActividad, comprobante, trimestreRealizacion FROM   alumnoActividades  JOIN actividades ON alumnoactividades.actividades_idActividad= actividades.idActividad WHERE matricula=:matrReg');
	    $statement->execute(array(
			':matrReg'=>$matricula
		));

		$resultadoTwo=$statement->fetchAll();
		//var_dump($resultadoTwo);

		if(empty($resultadoTwo)){
			$mensaje.= 'No hay ningun registro de actividades para este alumno';
			//echo $mensaje;
			//require 'views/whitoutActivityView.php';
		}
		$limit= count($resultadoTwo);
		//echo '</br>'. $limit;

		
		require 'views/queryActivityPdfView.php';
					  
	}else{
		header('Location: index.php');
	}


?>