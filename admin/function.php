<?php 
/*funcion para realizar la coneccion a la base de datos
el paramtero $bdConfig se encuentra en la configuracion*/


function conexion($bdConfig){
	try {
		$conexion= new PDO('mysql:host=localhost;dbname=' . $bdConfig['bdname'], 
			$bdConfig['user'], $bdConfig['passw']);
		return $conexion;
	} catch (PDOException $e) {
		return false;
	}
}

function limpiarDatos($datos){
	$datos=trim($datos);
	$datos=stripcslashes($datos);
	$datos=htmlspecialchars($datos);
	return $datos;
}


function insertCreditosComputacion($creditosConfig){
	$acumulador=0;
	$aux=[];
	$CredAcum=[];
	$resultado=[];

	for($i=0;$i<count($creditosConfig); $i++){
        
        $acumulador+= $creditosConfig[$i];
      	$CredAcum[$i]=$acumulador;
       	$aux[$i]=$creditosConfig[$i];
        //echo 'Trimestre:' . ($i+1) . '('. $acumulador . ')' .'('. $creditosConfig[$i] . ')'. '<br>';
    }
    $resultado[0]=$CredAcum;
	$resultado[1]=$aux;

    return $resultado;

}

function creditosPortrimestre($arregloCredAcum){
	$resultado=[];
	$CredAcum=[];
	$aux=[];
	$CredAcum=$arregloCredAcum;
	$aux[0]=$CredAcum[0];	
	for ($i=1; $i<count($CredAcum) ; $i++) { 
		$aux[$i]=$CredAcum[$i]-$CredAcum[$i-1];
	}
	//var_dump($CredAcum);
	//var_dump($aux);
	$resultado[0]=$CredAcum;
	$resultado[1]=$aux;
	return $resultado;
}


function cortar($agregar,$arreglo, $inicio, $final){
	//echo $inicio . '---' . $final . '</br>';
	$cont=1;
	$aux =[];
	$aux[0]=$agregar;
	for ($i=$inicio; $i<=$final; $i++) { 
		$aux[$cont]=$arreglo[$i][0];
		$cont++;
	}
	//var_dump($aux);
	return $aux;

	
	//echo'---------------' . '</br>';
}

function nuevo($arreglo){
	$aux=[];
	$aux[0]=0;
	$cont=1;
	for ($i=0; $i <count($arreglo) ; $i++) { 
		$aux[$cont]=$arreglo[$i];
	$cont++;
	}
	return $aux;
}


?>