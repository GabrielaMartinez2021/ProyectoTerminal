<?php session_start();
	require'fpdf/fpdf.php';
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
		$mensaje='';

		
		// llega de la pagina queryActivity y depende del que se seleccione
		$matricula=$_POST['matricula'];
		//echo $matricula;
		if(empty($matricula)){
			
			header('Location: queryActivity.php');
		}

		// consulta para obtener el trimestre de inicio del alumno
		$statement= $conexion->prepare('
		SELECT   nombre,primerApellido,segundoApellido FROM  alumnoTutor WHERE matricula=:matrReg');
	    $statement->execute(array(
			':matrReg'=>$matricula
		));
		
		$resultadoOne=$statement->fetch();
		//var_dump($resultadoOne);
		//echo $resultadoOne['trimestreingreso'];
		$nombreCompl='' .  $resultadoOne['primerApellido'] . $resultadoOne['segundoApellido'] . $resultadoOne['nombre'];

		$statement= $conexion->prepare('
		SELECT   descripcion, actividades.nombreActividad, comprobante, trimestreRealizacion FROM   alumnoActividades  JOIN actividades ON alumnoactividades.actividades_idActividad= actividades.idActividad WHERE matricula=:matrReg');
	    $statement->execute(array(
			':matrReg'=>$matricula
		));

		$resultadoTwo=$statement->fetchAll();
		//var_dump($resultadoTwo);

		
		$limit= count($resultadoTwo);
		//echo '</br>'. $limit;

		
		$fpdf = new FPDF();
		$fpdf->AddPage('PORTRAIT','A4');
		

		class pdf extends FPDF
		{
			
			public function header()
			{
				$this->SetFont('Times','B',12);
				$this->SetTextColor(67, 69, 69 );
				$this->Write(5,'Sistema para el seguimiento de alumnos tutorados en el programa de becas PRONABES');
			}
			public function footer()
			{
				$this->SetFont('Times','B',12);
				$this->SetTextColor(67, 69, 69 );
				$this->SetY(-15);
				$this->Write(5,'Universidad Autonoma Metropolitana        Unidad Azcapotzalco');
				$this->SetX(-15);
				$this->Write(5,$this->PageNo());
			}
		}
		if(empty($resultadoTwo)){
			$mensaje.= 'No hay ningun registro de actividades para este alumno';
			$fpdf= new pdf();
		$fpdf->AddPage('PORTRAIT','A4');
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->SetFont('Times','B',16);
		$fpdf->SetTextColor(22, 160, 160);
		$fpdf->Cell(0,5,'Historial de Actividades',0,0,'C');
		$fpdf->SetDrawColor(68, 121, 130);
		$fpdf->SetLineWidth(1);
		$fpdf->line(10,33,200, 33);

		$fpdf->SetLineWidth(0.1);
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->SetFont('Times', '',12);
		$fpdf->SetTextColor(3, 3, 3);
		$fpdf->SetFont('Times', 'B',12);
		$fpdf->Cell(21,5,'Nombre: ',0,0);
		$fpdf->SetFont('Times', '',12);
		$fpdf->Cell(127,5,''. $nombreCompl ,0,0);
		$fpdf->SetFont('Times', 'B',12);
		$fpdf->Cell(20,5,'Matricula: ',0,0);
		$fpdf->SetFont('Times', '',12);
		$fpdf->Cell(40,5,''. $matricula,0,0);
		$fpdf->Ln();

		// la tabla con valores encabezados
		$fpdf->Ln();
		$fpdf->SetFont('Times', 'B',13);
		$fpdf->SetFillColor(36, 152, 173);
		$fpdf->SetDrawColor(68, 121, 130 );
		$fpdf->SetTextColor(11, 68, 77);
		$fpdf->Cell(10,5,'No. ',1,0,'C',1);
		$fpdf->Cell(33,5,'Actividad ',1,0, 'C',1);
		$fpdf->Cell(30,5,'Comprobante ',1,0, 'C',1);
		$fpdf->Cell(25,5,utf8_decode('Trimestre'),1,0,'C',1);
		$fpdf->MultiCell(92,5,utf8_decode('Descripción'),1,'C',1);
		$fpdf->SetFont('Times', '',12);
		$fpdf->SetTextColor(206, 10, 10 );
		$fpdf->Cell(190,5,''. $mensaje,1,0, 'C');
		$fpdf->Output();
			
		}else{



		$fpdf= new pdf();
		$fpdf->AddPage('PORTRAIT','A4');
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->SetFont('Times','B',16);
		$fpdf->SetTextColor(22, 160, 160);
		$fpdf->Cell(0,5,'Historial de Actividades',0,0,'C');
		$fpdf->SetDrawColor(68, 121, 130);
		$fpdf->SetLineWidth(1);
		$fpdf->line(10,33,200, 33);

		$fpdf->SetLineWidth(0.1);
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->SetFont('Times', '',12);
		$fpdf->SetTextColor(3, 3, 3);
		$fpdf->SetFont('Times', 'B',12);
		$fpdf->Cell(21,5,'Nombre: ',0,0);
		$fpdf->SetFont('Times', '',12);
		$fpdf->Cell(127,5,''. $nombreCompl ,0,0);
		$fpdf->SetFont('Times', 'B',12);
		$fpdf->Cell(20,5,'Matricula: ',0,0);
		$fpdf->SetFont('Times', '',12);
		$fpdf->Cell(40,5,''. $matricula,0,0);
		$fpdf->Ln();

		// la tabla con valores encabezados
		$fpdf->Ln();
		$fpdf->SetFont('Times', 'B',13);
		$fpdf->SetFillColor(36, 152, 173);
		$fpdf->SetDrawColor(68, 121, 130 );
		$fpdf->SetTextColor(11, 68, 77);
		$fpdf->Cell(10,5,'No. ',1,0,'C',1);
		$fpdf->Cell(33,5,'Actividad ',1,0, 'C',1);
		$fpdf->Cell(30,5,'Comprobante ',1,0, 'C',1);
		$fpdf->Cell(25,5,utf8_decode('Trimestre'),1,0,'C',1);
		$fpdf->MultiCell(92,5,utf8_decode('Descripción'),1,'C',1);
		
		// la tabla con valores datos
		for ($i=0; $i <$limit ; $i++) {
			$link='http://localhost:8081/ProyectoTerminal/' . $resultadoTwo[$i][2]; 
			 $suma=$i+1; 
	                $resUno= $resultadoTwo[$i][1];
	                $resDos= $resultadoTwo[$i][0];
	                $resTres=$resultadoTwo[$i][3];
	                
			
			$fpdf->SetFont('Times', '',12);
			$fpdf->SetTextColor(0,0,0);
			$fpdf->Cell(10,10,''. $suma,1,0, 'C');
			$fpdf->Cell(33,10,utf8_decode(''. $resUno),1,0, 'C');

			$fpdf->SetFont('Times', 'U',12);
			$fpdf->SetTextColor(6, 69, 173);
			$fpdf->Cell(30,10,'Archivo',1,0,'C',false,$link);

			$fpdf->SetFont('Times', '',12);
			$fpdf->SetTextColor(0,0,0);
			$fpdf->Cell(25,10,utf8_decode(''. $resTres),1,0, 'C');
			$fpdf->MultiCell(92,10,utf8_decode(''. $resDos),1, 'C');
			}
		$fpdf->Output();
		}
		

		
		
		


		
					  
	}else{
		header('Location: index.php');
	}


?>