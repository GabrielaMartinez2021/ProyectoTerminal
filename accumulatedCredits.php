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
		$trimLetras=['I','P','O'];
		$estadoTrim='ACTUAL';
		$consuTabla;
		$consul;
		$resul;
		$arrayAcum=[];
		$i=0;
		$datos=[];
		$datosDos=[];

		// llega de la pagina tableAccumCredits y depende del que se seleccione
		// para ver su avance 
		$matricula=$_POST['matricula'];
		//echo $matricula;
		if(empty($matricula)){
			
			header('Location: tableAccumCredits.php');
		}

		// consulta para obtener el trimestre de inicio del alumno
		$statement= $conexion->prepare('
		SELECT  trimestreingreso, nombre,primerApellido,segundoApellido FROM  alumnoTutor WHERE matricula=:matrReg');
	    $statement->execute(array(
			':matrReg'=>$matricula
		));
		
		$resultadoOne=$statement->fetch();
		//var_dump($resultadoOne);
		//echo $resultadoOne['trimestreingreso'];

		// consulta para obtener el trimestre actual
		$statementTwo= $conexion->prepare('
		SELECT  trim FROM  trimestres WHERE estadoTrim=:trimActu');
	    $statementTwo->execute(array(
			':trimActu'=>$estadoTrim
		));
		$resultadoTwo=$statementTwo->fetch();
		//var_dump($resultadoTwo);
		//echo $resultadoTwo['trim'];

		$trimInicio=$resultadoOne['trimestreingreso'];
		$trimActu=$resultadoTwo['trim'];
		//$trimActu='19P';
		

		// consulta para obtener los creditos acumulados

		$consuTabla='trim20' . $trimInicio;
		$sql = 'SELECT creditosAcum FROM ' . $consuTabla . ' WHERE  matricula=:matrReg';
		//echo $consuTabla . 'esto es la tabla a consultar' . '</br>';
		$statementThree= $conexion->prepare($sql);
	    $statementThree->execute(array(
			':matrReg'=>$matricula
		));
		$resultadoThree=$statementThree->fetch();
		//var_dump($resultadoThree);

		$arrayAcum[$i]=$resultadoThree['creditosAcum'];
		$i++;


		while($trimInicio!=$trimActu){
			$anioTrim = str_split($trimInicio);
			$anio=$anioTrim[0].$anioTrim[1];
			$trimLetra=$anioTrim[2];
			//echo $anio .'</br>';
			//echo $trimLetra .'</br>';
			//echo '</br>';
			//echo '</br>';
			//$i;

			if($trimLetra==$trimLetras[2]){
					$anio++;
					$trimLetra=$trimLetras[0];
					$trimInicio=$anio . $trimLetra;
					$consuTabla='trim20' . $trimInicio;
					//echo $anio . $trimLetra .'</br>';
					
				}else if($trimLetra==$trimLetras[0]){
					$trimLetra=$trimLetras[1];
					$trimInicio=$anio . $trimLetra;
					$consuTabla='trim20' . $trimInicio;
					//echo $anio . $trimLetra .'</br>';
				}else if($trimLetra==$trimLetras[1]){
					$trimLetra=$trimLetras[2];
					$trimInicio=$anio . $trimLetra;
					$consuTabla='trim20' . $trimInicio;
					//echo $anio . $trimLetra .'</br>';
				} 

				//echo $consuTabla .'</br>';
				$sql = 'SELECT creditosAcum FROM ' . $consuTabla . ' WHERE  matricula=:matrReg';
				$consul='statementFour' . $consuTabla;
				$resul='resultadoFour' . $consuTabla;

				$consul= $conexion->prepare($sql);
			    $consul->execute(array(
					':matrReg'=>$matricula
				));
				$resul=$consul->fetch();
				//var_dump($resul);

				$arrayAcum[$i]=$resul['creditosAcum'];
				$i++;
				
		}
		//var_dump($arrayAcum);
		// aqui hay dos arreglos ver funciones, estan los realizados por el amlumno
		$datosDos=creditosPortrimestre($arrayAcum);
		$limit=count($arrayAcum);
		//echo 'este es el limite' .  $limit;
		//var_dump($datosDos);
		// aqui hay dos arreglos ver funciones estan los reales para la carrera de computacion
		$datos=insertCreditosComputacion($creditosConfig);
		//var_dump($datos);

		//var_dump($datos);
		/*estos son los arreglos donde se encuntran los datos para cada trimestre, los reales*/
		/*for ($i=0; $i <count($datos)/2 ; $i++) {

				echo $datos['acumulado'. $i] .'    ' . $creditosConfig[$i] .  '<br>' ;
		}*/

		require 'views/accumulatedCreditsView.php';
					  
	}else{
		header('Location: index.php');
	}


?>