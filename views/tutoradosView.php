<?php require 'headerContentsView.php' ?>

	<main class=" seccion tutorados">
		<h2 class="fw-400 text-center">Lista de tutorados</h2>
		<hr>

            <fieldset>

            	<legend>Tutorados</legend>
            	
                <table>
                	<!--<caption>Alumnos Tutorados</caption>-->
                	<thead>
	                	<tr>
	                		<th>Nombre Completo</th>
			                <th>Matricula</th>
			                <th>Año de Ingreso</th>
			                <th>Trimestre de Ingreso</th>
			                <th>Licenciatura</th>
			                <th>Correo</th>
			                <th>Telefono</th>
			                <th>Beca Activa</th>
	                	</tr>
	                </thead>
                		<?php foreach ($resultados as $tutorado): ?>
							<tr>

							  <td><?php echo $tutorado['primerApellido'] . ' ' . $tutorado['segundoApellido'] . ' ' . $tutorado['nombre']; ?></td>
							  <td><?php echo $tutorado['matricula']; ?></td>
							  <td><?php echo $tutorado['anioIngreso']; ?></td>
							  <td><?php echo $tutorado['trimestreingreso']; ?></td>
							  <td><?php echo $tutorado['licenciatura']; ?></td>
							  <td><?php echo $tutorado['correo']; ?></td>
							  <td><?php echo $tutorado['telefono']; ?></td>
							  <td><?php echo $tutorado['becaActiva']; ?></td>
							  
							</tr>
							<?php endforeach ?>

				</table>
			</fieldset>

                <a href="menu.php"  class="boton boton-verde ">Regresar Atrás</a>
  
	</main>


<?php require 'footerView.php' ;?>