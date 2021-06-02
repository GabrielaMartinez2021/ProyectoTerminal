<?php session_start();
//para saber quien es el que esta iniciando sesion.
//print_r($_SESSION['user']);
	require 'admin/configuration.php';
	require 'admin/function.php';
	
	if (isset($_SESSION['user'])) {
		$matrReg=$_POST['matriculaPost'];
		
		if(empty($matrReg)){
			
			header('Location: tableActivityRegister.php');
		}

		/*Tomar en nombre de as actividades de la base de datos*/
		$conexion= conexion($bdConfig);
		$statement= $conexion->prepare('SELECT nombreActividad FROM actividades');
		$statement->execute();
		$resultado=$statement->fetchAll();

		/*Obtener el nombre completo del alumno dependiendo la matricula*/

		$statementTwo= $conexion->prepare('
			SELECT  primerApellido, segundoApellido,nombre FROM  alumnoTutor WHERE matricula=:matrReg');
		$statementTwo->execute(array(
			':matrReg'=>$matrReg
		));
		$resultadoDos=$statementTwo->fetch();
			
		//var_dump($resultadoDos);

		/* esta variable viene por la url de la pagina tableActivityRegister.php  esta definida en la parte donde se carga los datos para la tabla en el html*/
		//echo $_GET['matriRegActividad'];

		//var_dump($resultado);

		
		/*   Registro de los datos de la activida a la base de datos   */
		if ($_SERVER['REQUEST_METHOD']=='POST' && !empty($_FILES)) {

			$matricula=($_POST['matriculaTwo']);
			$descripcion=($_POST['descripcion']);
			$trimestreRealizacion=($_POST['trimestre']);
			$actR=($_POST['actividadRealizar']);

			//para obtener el id del alumno
			$statementIdTutor= $conexion->prepare('
			SELECT idAlumnoTutor FROM  alumnoTutor WHERE matricula=:matrReg');
			$statementIdTutor->execute(array(
			':matrReg'=>$matricula
			));
			$resultadoId=$statementIdTutor->fetch();
			

			//para que el usuario suba el comprobante
			$carpetaDestino='comprobantesActividades/';
			$archivoSubido=$carpetaDestino . $_FILES['subirComprobante']['name'];
			//echo $archivoSubido;
			move_uploaded_file($_FILES['subirComprobante']['tmp_name'], $archivoSubido);
			
			/* Consulta el id de la actividad a registrar*/
			$statementThree= $conexion->prepare('
			SELECT idActividad FROM actividades WHERE nombreActividad=:actR');
			/*Ejecutar la sentencia*/
			$statementThree->execute(array(
				':actR'=>$actR
			));

			$resultadoTres=$statementThree->fetch();
			$idactReg=$resultadoTres['idActividad'];
			var_dump($resultadoTres);
			/* registra todos los datos*/

			
			$statementFour= $conexion->prepare('INSERT INTO alumnoActividades(idAlumnoActividades,matricula,descripcion,trimestreRealizacion, comprobante, actividades_idActividad, alumnoTutor_idAlumnoTutor) VALUES (null, :matricula, :descripcion, :trimestreRealizacion,:comprobante, :actRactReg, :idAlumno)');
			

			/*Ejecutar la sentencia*/
			$statementFour->execute(array(
					':matricula'=>$matricula,
					':descripcion'=>$descripcion,
					':trimestreRealizacion'=>$trimestreRealizacion,
					':comprobante'=> $archivoSubido,
					':actRactReg'=>$idactReg,
					':idAlumno'=>$resultadoId['idAlumnoTutor']
				));

			$resultadoCuatro=$statementFour->fetch();
			//var_dump($resultadoCuatro);
			//echo  $matricula . '</br>';
			//echo  $descripcion . '</br>';
			//echo  $trimestreRealizacion . '</br>';
			//echo  $archivoSubido . '</br>';
			//echo  $idactReg . '</br>';
			//echo  $resultadoId['idAlumnoTutor'] . '</br>';

		}


		require 'views/activityRegisterView.php';

	}else{
		header('Location: index.php');
	}

?>