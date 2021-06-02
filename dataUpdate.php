<?php 
	require 'admin/configuration.php';
	require 'admin/function.php';

	$error='';

	$trimActual='ACTUAL';

	$conexion= conexion($bdConfig);

		if (!$conexion) {
				echo "no se conecto<br>";
		}else{
				//echo "succesfull!!<br>";
		}

	if ($_SERVER['REQUEST_METHOD']=='POST') {

		$statement= $conexion->prepare('
		SELECT  trim,estadoTrim FROM  trimestres WHERE estadoTrim=:estadoTrim');
	    $statement->execute(array(
			':estadoTrim'=>$trimActual
		));
		
		$resultadoOne=$statement->fetch();
		//var_dump($resultadoOne);
		$trimActu=$resultadoOne[0];
		echo $trimActu;
		for ($i=17; $i <=21 ; $i++) { 
		 $trimestres[]= $i . 'I';
		 $trimestres[]= $i . 'P';
		 $trimestres[]= $i . 'O';
	}
	//var_dump($trimestres);

	for ($i=0; $i <count($trimestres) ; $i++) { 
		if($trimActu==$trimestres[$i]){
			$oldTrim=$trimestres[$i];
			$newTrimAct=$trimestres[$i+1];
		}
	}
	//echo $newTrimAct;
	$nameTabla='trim20'. $newTrimAct;
	//echo $nameTabla; 
	//echo '</br>';
	$id='idTrim20' . $newTrimAct;
	$ante='ANTERIOR';
	$actu='ACTUAL';
	

	$statement= $conexion->prepare('CREATE TABLE '. $nameTabla . '( 
		idTrim int AUTO_INCREMENT PRIMARY KEY,
		matricula varchar(11),
		creditosAcum int,
		ultimoTrimAct varchar(7),
		estadoAlumno_idestadoAlumno INT NOT NULL,
		FOREIGN KEY (estadoAlumno_idestadoAlumno) REFERENCES estadoAlumno (idestadoAlumno),
		alumnoTutor_idAlumnoTutor INT NOT NULL,
		FOREIGN KEY (alumnoTutor_idAlumnoTutor) REFERENCES alumnoTutor (idAlumnoTutor),
		trimestres_idTrimestre INT NOT NULL,
		FOREIGN KEY (trimestres_idTrimestre) REFERENCES trimestres (idTrimestre)
		)ENGINE=InnoDB');

	    $statement->execute(array());	
		//$resultadoOne=$statement->fetch();

	$statement= $conexion->prepare('
		UPDATE trimestres SET estadoTrim=:ante WHERE trim=:old');
	    $statement->execute(array(
	    	':ante'=>$ante,
			':old'=>$oldTrim

		));
		
		$resultadoOne=$statement->fetch();
		
		$statement= $conexion->prepare('
		INSERT INTO trimestres (idTrimestre,trim,estadoTrim) values (null, :trimes, :estadoTrim)');
	    

		if ($statement->execute(array(
	    	':trimes'=>$newTrimAct,
			':estadoTrim'=>$actu

		))) {
			 $error.= 'Se ha creado la tabla exitosamente.';
		} else {
			 $error.= 'No Se pudo crear la tabla.';
		}

	}
	require 'views/dataUpdateView.php';


?>