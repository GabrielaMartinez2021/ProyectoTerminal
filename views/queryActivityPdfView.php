
<?php require 'headerContentsView.php' ?>

	<main class="seccion registro">
		<h2 class="fw-400 text-center">Consulta de Actividades Realizadas por Alumno</h2>
		<hr>

            <fieldset>
	            <legend>Historial de creditos</legend>

		            <div class="centrar">
		            	<div class="centrar">
			            	<label>Alumno:</label>
			            	<p> <?php echo $resultadoOne['primerApellido'] . $resultadoOne['segundoApellido'] . $resultadoOne['nombre'] ?></p>
			            </div>
			            <div class="centrar">
		            		<label>Matricula:</label>
		            		<p><?php echo $matricula ?></p>
		            	</div>
	            	</div>

	            	<?php if($limit!=0){ ?>
                <table>
                	<thead>
	                	<tr>
	                		<th>No.</th>
	                		<th>Actividad</th>
			                <th>Descripcion</th>
			                <th>Comprobante</th>
			                <th>Trimestre de realización</th>
	                	</tr>
	                </thead>
					
	                <?php for ($i=0; $i <$limit; $i++) { ?>
						<tr>
							<!--Trimestre -->
							<td><?php echo $i+1 ?></td>
							<!--esperado -->
							<td><?php echo  $resultadoTwo[$i][1]; ?></td> 
							<!--cubierto -->
							<td><?php echo  $resultadoTwo[$i][0]; ?></td>
							<!--cubierto -->
							<td> <a target="_blank" href="<?php echo  $resultadoTwo[$i][2]; ?>">Archivo</a></td>
							<!--cubierto -->
							<td><?php echo  $resultadoTwo[$i][3]; ?></td>
								
						</tr>
					<?php } ?>
				<?php }else {?>
					<table>
                	<thead>
	                	<tr>
	                		<th>No.</th>
	                		<th>Actividad</th>
			                <th>Descripcion</th>
			                <th>Comprobante</th>
			                <th>trimestre De Realización</th>
	                	</tr>
	                </thead>
	            </table>
					<div class="error">
	            	<p><?php echo $mensaje; ?></p>

	            </div>
	        <?php } ?>
					
				</table>
			</fieldset>
			<div class="centrarN">
				<a href="tableAccumCredits.php"  class="boton boton-verde ">Regresar Atrás</a>
				<a href="menu.php"  class="boton boton-verde ">Regresar al menú</a>
				<form action="activityPdf.php" method="POST" target="_blank">
				<p>Descargar PDF:<input class="boton boton-verde " name="matricula" type="submit" value="<?php echo $matricula; ?>"></p>			
			</div>
		
		

		
							  		
		</form>
	
	</main>
	<?php require 'footerView.php' ;?>
	




