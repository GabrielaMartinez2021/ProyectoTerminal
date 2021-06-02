<?php require 'headerContentsView.php' ?>


	<main class="seccion registro">
		<h2 class="fw-400 text-center">Consultar Creditos Acumulados por Alumno</h2>
		<hr>

            <fieldset>

            	<legend>Tutorados</legend>
            	
                <table>
                	<!--<caption>Alumnos Tutorados</caption>-->
                	<thead>
	                	<tr>
	                		<th>Nombre Completo</th>
			                <th>Matricula</th>
			                <th>Beca Activa</th>
	                	</tr>
	                </thead>
	               
                		<?php foreach ($resultados as $tutorado): ?>
                			<?php $matRegAct=$tutorado['matricula']; ?>
							<tr>

							  <td><?php echo $tutorado['primerApellido'] . ' ' . $tutorado['segundoApellido'] . ' ' . $tutorado['nombre']; ?></td>
							  <td>
							  	<form action="accumulatedCredits.php" method="POST">

							  		<input class="botonEnlace" name="matricula" type="submit" value="<?php echo $tutorado['matricula']; ?>">
							  		
							  	</form>
							  </td>
							  
							  <td><?php echo $tutorado['becaActiva']; ?></td>  
							</tr>
							<?php endforeach ?>
					

				</table>
			</fieldset>	
                
                <a href="menu.php"  class="boton boton-verde ">Regresar Atrás</a>
  
	</main>


<?php require 'footerView.php' ;?>