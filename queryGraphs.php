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


		$arregloMatriculas=[];
		$arregloTrimInicio=[];
		$consuTabla=[];
		$creditosAcum=[];
		$j=0;
		$k=0;
		$datosDos=[];
		$id;
		$colores=array(
			"rgb(72, 194, 34)",
			"rgb(217, 106, 82)",
			"rgb(155, 203, 36)",
			"rgb(23, 229, 207)",
			"rgb(23, 61, 229)",
			"rgb(116, 106, 176)",
			"rgb(152, 39, 67)",
			"rgb(152, 39, 123)"
		);
		$estBecaSi=[];
		$estBecaNo=[];
		$varSi=0;
		$varNo=0;

		//para tener los datos del usuario que inicio sesion
		$user=$_SESSION['user'];

		// consulta para obtener el id del profesor 
		$statement= $conexion->prepare('
			SELECT idTutor FROM tutor WHERE numeroEco=:user');
		/*Ejecutar la sentencia*/
		$statement->execute(array(
			':user'=>$user
		));
		$resultado=$statement->fetch();
		$idProfesor=$resultado['idTutor'];

		//consulta para obtener las matriculas de los alumnos
		$statementTwo= $conexion->prepare('
			SELECT matricula FROM  alumnoTutor WHERE tutor_idTutor=:idProfesor');
		/*Ejecutar la sentencia*/
		$statementTwo->execute(array(
			':idProfesor'=>$idProfesor
		));

		$resultTwo=$statementTwo->fetchAll();
		// aqui en resultTwo esta la matricula de los alumnos del profesor en sesion.
		//var_dump($resultTwo);
		

		/*for ($i=0; $i <count($resultTwo) ; $i++) { 

			echo $resultTwo[$i][0] . '</br>';
		}*/
			// consulta para obtener el trimestre de inicio de cada uno de los alumno
		for ($i=0; $i <count($resultTwo) ; $i++) { 
			$statementThree= $conexion->prepare('
			SELECT  trimestreingreso,matricula FROM  alumnoTutor WHERE matricula=:matri');
		    $statementThree->execute(array(
		    		':matri'=>$resultTwo[$i][0]
			));
			
			$resultThree[$i]=$statementThree->fetchAll();
			
		}
		// en este arreglo estan las matriculas de los alumnos y el trimestre en el que iniciaron.
		//var_dump($resultThree);
		//  asi es como se accede para el trimestre
		for ($i=0; $i <count($resultThree) ; $i++) { 
			//  asi es como se accede para el trimestre de inicio
			$arregloMatriculas[$i]=$resultThree[$i][0][1];
			$arregloTrimInicio[$i]=$resultThree[$i][0][0];
			//echo $resultThree[$i][0][0] . '</br>';
			//  asi es como se accede para la matricula
			//echo $resultThree[$i][0][2] . '</br>';

			//echo $arregloMatriculas[$i] . '</br>';
			//echo $arregloTrimInicio[$i] . '</br>';
		}
		// en este arreglo se encuentran las matriculas
		//var_dump($arregloMatriculas);
		//echo '</br>' . '</br>' . '</br>';
		// en este arreglo se encuntra el trimestre en el que iniciaron.
		//var_dump($arregloTrimInicio);

		// consulta para obtener el trimestre actual
		$statementFour= $conexion->prepare('
		SELECT  trim FROM  trimestres WHERE estadoTrim=:trimActu');
	    $statementFour->execute(array(
			':trimActu'=>$estadoTrim
		));
		$resultFour=$statementFour->fetch();
		$trimActu=$resultFour['trim'];
		//$trimActu='19P';

		//echo '</br>'. 'Trimestre Actual: ' . $trimActu . '</br>';

		for ($i=0; $i <count($arregloTrimInicio) ; $i++) { 
			$consuTabla[$i]='trim20' . $arregloTrimInicio[$i];
		}
		// en este arreglo se encuentra la tabla que se tiene que consultar, apartir del trimestre de inicio del alumno.
		//var_dump($consuTabla);

		// obtener los creditos acmulados de cada alumno 
		for ($i=0; $i<count($arregloMatriculas) ; $i++) { 
			
			$sql = 'SELECT creditosAcum FROM ' . $consuTabla[$i] . ' WHERE  matricula=:matrReg';
			//echo $consuTabla . 'esto es la tabla a consultar' . '</br>';
			$statementFive= $conexion->prepare($sql);
		    $statementFive->execute(array(
				':matrReg'=>$arregloMatriculas[$i]
			));
			
			$resultadoFive[$i]=$statementFive->fetch();
			
		}
		// en este arreglo se encuentran los creditos acumulados
		//var_dump($resultadoFive);
		for ($i=0; $i<count($resultadoFive) ; $i++) { 
			$creditosAcum[$i]=$resultadoFive[$i][0];
		}
		//echo 'Arreglo creditos iniciales: ';
		//var_dump($creditosAcum);
		

		for ($j=0; $j <count($resultadoFive) ; $j++) { 
			while($arregloTrimInicio[$j]!=$trimActu){
			$anioTrim = str_split($arregloTrimInicio[$j]);
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
					$arregloTrimInicio[$j]=$anio . $trimLetra;
					$consuTabla='trim20' . $arregloTrimInicio[$j];
					//echo $anio . $trimLetra .'</br>';
					
				}else if($trimLetra==$trimLetras[0]){
					$trimLetra=$trimLetras[1];
					$arregloTrimInicio[$j]=$anio . $trimLetra;
					$consuTabla='trim20' . $arregloTrimInicio[$j];
					//echo $anio . $trimLetra .'</br>';
				}else if($trimLetra==$trimLetras[1]){
					$trimLetra=$trimLetras[2];
					$arregloTrimInicio[$j]=$anio . $trimLetra;
					$consuTabla='trim20' . $arregloTrimInicio[$j];
					//echo $anio . $trimLetra .'</br>';
				} 

				//echo $consuTabla .'</br>';
				$sql = 'SELECT creditosAcum FROM ' . $consuTabla . ' WHERE  matricula=:matrReg';
				$consul= $conexion->prepare($sql);
			    $consul->execute(array(
					':matrReg'=>$arregloMatriculas[$j]
				));
    
				$resul[$k]=$consul->fetch();
				$k++;

		    }
		    // S e guarda la posicion donde finalizan los creditos
		    if($arregloTrimInicio[$j]==$trimActu){
					$limitCred[]=$k-1;
				}
		   
		}
		//echo '</br>'. 'resul' . '</br>';
		//var_dump($resul);
		//echo '</br>'. 'esto es limite';
		//var_dump($limitCred);


		$inicio =0;
		$indicefinal=0;
		$final = 0;
		$aux = [];
		$trimAcumFinal = [];
		$cont=0;
		$cont2=0;

		for ($inicio=0; $inicio<count($resul)-1 ; $inicio =$final+1) { 

	     	$final= $limitCred[$indicefinal];
		    $indicefinal ++;
		
	     $aux=cortar($creditosAcum[$cont], $resul, $inicio, $final);
	     //echo $creditosAcum[$cont] . '</br>';
	    $cont++;
	     $trimAcumFinal[] = $aux;
	     //var_dump($aux);

		}

		//var_dump($trimAcumFinal);
		//var_dump($aux);
		// echo gettype($aux);
 		
 		// Aqui se encuentran los datos cumplidos por trimestre de lo realizado por el alumno 
		for ($i=0; $i <count($trimAcumFinal) ; $i++) { 
			//echo '</br>' . $aux[$i][0];
			$datosDos[$i]=creditosPortrimestre($trimAcumFinal[$i]);

		}
		//var_dump($datosDos);
		for ($i=0; $i <count($datosDos) ; $i++) { 
			$arregloVista[]=nuevo($datosDos[$i][0]);
		}
		//var_dump($arregloVista);
		//echo json_encode($datosDos);

		//esto esta bien 
		// aqui hay dos arreglos ver funciones estan los reales para la carrera de computacion
		$datos=insertCreditosComputacion($creditosConfig);
		//var_dump($datos);

		//echo json_encode($res);


		// para la grafica de barras
		//echo $trimActu;
		$consultaTab='trim20'. $trimActu;
		//echo $consultaTab;
		$m=0;
		for ($i=0; $i<count($arregloMatriculas) ; $i++) { 
			
			$sql = 'SELECT matricula FROM ' . $consultaTab . ' WHERE  matricula=:matrReg and estadoAlumno_idestadoAlumno=1';
			//echo $consuTabla . 'esto es la tabla a consultar' . '</br>';
			$statementFive= $conexion->prepare($sql);
		    $statementFive->execute(array(
				':matrReg'=>$arregloMatriculas[$i]
			));
			
			$EstadadoUno[$i][0]=$statementFive->fetch();
			if($EstadadoUno[$i][0]!=false){

				$EstadadoUnof[$m]= $EstadadoUno[$i][0];
				$m++;
			}
			
		}
		//var_dump($EstadadoUnof);
		for ($i=0; $i <count($EstadadoUnof) ; $i++) { 
			$estMatri[$i]=$EstadadoUnof[$i][0];
		}
		//var_dump($estMatri);
		// aqui estaran los que estan activos.

		// consulta de los alumnos para saber 
		for ($i=0; $i<count($estMatri) ; $i++) { 
			
			$sql = 'SELECT matricula FROM  alumnoTutor  WHERE  matricula=:matrReg and becaActiva="si"';
			//echo $consuTabla . 'esto es la tabla a consultar' . '</br>';
			$statementFivel= $conexion->prepare($sql);
		    $statementFivel->execute(array(
				':matrReg'=>$estMatri[$i]
				
			));
			
			
			$estBecaSi[$i]=$statementFivel->fetch();
		
		}
		//var_dump($estBecaSi);
		for ($i=0; $i <count($estBecaSi); $i++) { 
			if ($estBecaSi[$i]==false) {
				$varNo++;
			}else{
				$varSi++;
			}
		}

		//echo '</br>' . $varSi;
		//echo '</br>' . $varNo;

		require 'views/queryGraphsView.php';
					  
	}else{
		header('Location: index.php');
	}


?>