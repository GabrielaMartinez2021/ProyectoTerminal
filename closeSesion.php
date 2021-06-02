<?php session_start();

require 'admin/configuration.php';
require 'admin/function.php';

	session_destroy();
	$_SESSION=array();

	header('Location: index.php');
?>