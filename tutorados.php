<?php 
session_start();
# aparecera el codigo html que tengamos y tambien reconocera el otro archivo las variables que se tengan aqui 
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

	//para tener los datos del usuario que inicio sesion
	$user=$_SESSION['user'];
	//echo $user . 'este es el usuario';

	$statement= $conexion->prepare('
		SELECT idTutor FROM tutor WHERE numeroEco=:user');
	/*Ejecutar la sentencia*/
	$statement->execute(array(
		':user'=>$user
	));

	$resultado=$statement->fetch();
	//var_dump($resultado);
	$idProfesor=$resultado['idTutor'];
	//echo 'esto es el id del prof actual: ' .  $idProfesor . '</br>';

	//select nombre from  alumnoTutorado where profesor_idProfesor=1;

	$statementTwo= $conexion->prepare('
		SELECT * FROM  alumnoTutor WHERE tutor_idTutor=:idProfesor');
	/*Ejecutar la sentencia*/
	$statementTwo->execute(array(
		':idProfesor'=>$idProfesor
	));

	$resultados=$statementTwo->fetchAll();
	//print_r($resultadodos);
	/*foreach ($resultados as $tutorado) {
		//echo $tutorado['primerApellido'] . ' ' . $tutorado['segundoApellido'] . '</br>';
	}*/

	require 'views/tutoradosView.php';


		}else{
			header('Location: index.php');
		}

?>