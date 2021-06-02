<?php 
session_start();
# aparecesa el codigo html que tengamos y tambien reconocera el otro archivo las variables que se tengan aqui 
require 'admin/configuration.php';
require 'admin/function.php';


	if (isset($_SESSION['user'])) {
		require 'views/registerView.php';
	}else{
		header('Location: index.php');
	}


	$conexion= conexion($bdConfig);

	if (!$conexion) {
			echo "no se conecto<br>";
	}else{
			//echo "succesfull!!<br>";
	}

	$user=$_SESSION['user'];
	//echo $user . 'este es el usuario';

	$statement= $conexion->prepare('
		SELECT * FROM tutor WHERE numeroEco=:user');
	/*Ejecutar la sentencia*/
	$statement->execute(array(
		':user'=>$user
	));


	$resultado=$statement->fetch();
	//var_dump($resultado['idProfesor']);
	//$idProfesor=$resultado['idProfesor'];
	//echo 'esto es el id del prof actual: ' .  $idProfesor ;

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		// limpiarDatos(filter_var($_POST['user'], FILTER_SANITIZE_STRING));
		$nombre=limpiarDatos(filter_var($_POST['nombre'], FILTER_SANITIZE_STRING));
		$primerApellido=limpiarDatos(filter_var($_POST['primerApellido'], FILTER_SANITIZE_STRING));
		$segundoApellido=limpiarDatos(filter_var($_POST['segundoApellido'], FILTER_SANITIZE_STRING));
		$matricula=($_POST['matricula']);
		$anioIngreso=($_POST['anioIngreso']);
		$trimestreIngreso=($_POST['trimestreIngreso']);
		$licenciatura=(filter_var($_POST['licenciatura'], FILTER_SANITIZE_STRING));
		$estadoBeca=($_POST['beca']);
		$correo=limpiarDatos($_POST['email']);
		$telefono=($_POST['telefono']);
		$idProfesor=$resultado['idTutor'];

		//echo $nombre . ' esta es el nombre.';

		$statement=$conexion->prepare ('INSERT INTO alumnoTutor(idAlumnoTutor,nombre,primerApellido,segundoApellido,matricula,anioIngreso,trimestreingreso,licenciatura,correo,telefono,becaActiva,tutor_idTutor)  VALUES (null, :nombre, :primerApellido, :segundoApellido, :matricula, :anioIngreso, :trimestreIngreso, :licenciatura, :correo, :telefono, :beca, :idProfesor)');

		$statement->execute(array(
			':nombre'=>$nombre,
			':primerApellido'=>$primerApellido,
			':segundoApellido'=>$segundoApellido,
			':matricula'=>$matricula,
			':anioIngreso'=>$anioIngreso,
			':trimestreIngreso'=>$trimestreIngreso,
			':licenciatura'=>$licenciatura,
			':correo'=>$correo,
			':telefono'=>$telefono,
			':beca'=>$estadoBeca,
			':idProfesor'=>$idProfesor
		));
	

	}

?>