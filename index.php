<?php 

session_start();
# aparecesa el codigo html que tengamos y tambien reconocera el otro archivo las variables que se tengan aqui 
require 'admin/configuration.php';
require 'admin/function.php';

if(isset($_SESSION['user'])){
	
	header('Location: menu.php');
	
}else{	
		require 'views/loginView.php';

	/*Este es para ver que se esta escribiendo en los campos de texto */
	/*echo "$user - $password";*/
}

	$conexion= conexion($bdConfig);

	if($_SERVER['REQUEST_METHOD']== 'POST'){

	//$user= filter_var($_POST['user'], FILTER_SANITIZE_STRING);
	$user= limpiarDatos(filter_var($_POST['user'], FILTER_SANITIZE_STRING));
	$password= limpiarDatos($_POST['password']);

	// sentencia SQL para consultar con la base de datos. 
	$statement= $conexion->prepare('
		SELECT * FROM tutor WHERE numeroEco=:user AND passw=:password');
	/*Ejecutar la sentencia*/
	$statement->execute(array(
		':user'=>$user,
		':password'=>$password
	));

	$resultado=$statement->fetch();
	var_dump($resultado);
	/*if(empty($user) && empty($password)){
		echo 'estan vacias';
	}*/
	if($resultado != false){
		$_SESSION['user']= $user;
		header('Location: menu.php');
	}else{
		header('Location: indexTwo.php');
	}
/*se realiza la coneccion a la base de datso por medio de la funcion que esta en function.php*/
	

	//echo 'Esta es la variable errores: ' . $errores;
	/*para comproar si hay coneccion con la base de datos*/
	/*if (!$conexion) {
		echo "no se conecto<br>";
	}else{
		echo "succesfull!!<br>";
	}*/
}

//require 'views/loginView.php';
?>