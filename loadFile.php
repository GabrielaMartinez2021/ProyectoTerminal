<?php 
	require 'admin/configuration.php';
	require 'admin/function.php';

	$error='';

	$conexion=conexion($bdConfig);

		if (!$conexion) {
				echo "no se conecto<br>";
		}else{
				//echo "succesfull!!<br>";
		}
		$archivo=fopen("filesNew/19I.csv", "r");


	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		
		while(($datos = fgetcsv($archivo, ",")) == true){
			/*echo 'Numero: ' .  $datos[0] . '</br>';
			echo 'Mat: ' . $datos[1] . '</br>';
			echo 'Acum: ' . $datos[2] . '</br>';
			echo 'trim: ' . $datos[3] . '</br>';
			echo 'forin1: ' . $datos[4] . '</br>';
			echo 'forin2: ' . $datos[5] . '</br>';
			echo 'forin3: ' . $datos[6] . '</br>';
			echo '</br>';*/

			$statement= $conexion->prepare('
			INSERT INTO trim2019P (idTrim,matricula,creditosAcum, ultimoTrimAct,estadoAlumno_idestadoAlumno, alumnoTutor_idAlumnoTutor , trimestres_idTrimestre ) values (null, :uno, :dos , :tres, :cuatro, :cinco, :seis)');
		    $statement->execute(array(
				':uno'=>$datos[1],
				':dos'=>$datos[2],
				':tres'=>$datos[3],
				':cuatro'=>$datos[4],
				':cinco'=>$datos[5],
				':seis'=>$datos[6]
			));
			
		}
		if ($statement->execute()) {
			 $error.= 'Se Insertaron los Datos Correctamente';
		} else {
			 $error.= 'No Se Insertaron los Datos';
		}
		
		
	}
	require 'views/loadFileVew.php';


	

?>