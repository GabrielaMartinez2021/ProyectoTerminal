<?php session_start();
//para saber quien es el que esta iniciando sesion.
//print_r($_SESSION['user']);
require 'admin/configuration.php';
require 'admin/function.php';

if (isset($_SESSION['user'])) {
	require 'views/menuView.php';
}else{
	header('Location: index.php');
}

//require 'views/menuView.php';
?>