<?php require 'headerGraphicsView.php' ?>
	<main class="seccion registro">
		<h2 class="fw-400 text-center">Consulta de Creditos Acumulados por Alumno</h2>
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
                <table>
                	<thead>
	                	<tr>
	                		<th>Trimestre</th>
			                <th>Esperado</th>
			                <th>Cubierto</th>
	                	</tr>
	                </thead>
					
	                <?php for ($i=0; $i <$limit; $i++) { ?>
						<tr>
							<!--Trimestre -->
							<td><?php echo $i+1 ?></td>
							<!--esperado -->
							<td><?php echo  $datos[0][$i]  . '(' . $datos[1][$i] . ')' ?></td> 
							<!--cubierto -->
							<td><?php echo  $datosDos[0][$i]  . '(' . $datosDos[1][$i] . ')' ?></td>
								
						</tr>
					<?php } ?>
					
				</table>
			</fieldset>

			<fieldset>
	            <legend>Grafica del avance del alumno</legend>
					<div class="graf">
						<canvas id="canvas"></canvas>
					</div>
				<script>
					var config = {
						type: 'line',
						data: {
							labels: [ 
							<?php for ($i=0; $i <=$limit ; $i++){ ?>
           					'<?php echo $i; ?>',
            				<?php } ?>
            				],

							datasets: [{
								label: 'Cubierto',
								data: [0,
									<?php for ($num=0; $num <$limit ; $num++){ ?>
           					'<?php echo  $datosDos[0][$num]; ?>',
            				<?php } ?>
									
								],
								backgroundColor: window.chartColors.blue,
								borderColor: window.chartColors.blue,
								fill: false,
								borderDash: [5, 5],
								pointRadius: [1, 2, 3, 4, 5, 6, 7,8,9,10,11,12],
							}, {
								label: 'Esperado',
								data: [0,
									<?php for ($i=0; $i <=$limit ; $i++){ ?>
           					'<?php echo  $datos[0][$i]; ?>',
            				<?php } ?>
								],
								backgroundColor: window.chartColors.yellow,
								borderColor: window.chartColors.yellow,
								fill: false,
								pointHitRadius: 20,
							}]
						},
						options: {
							responsive: true,
							legend: {
								position: 'bottom',
							},
							hover: {
								mode: 'index'
							},
							scales: {
								xAxes: [{
									display: true,
									scaleLabel: {
										display: true,
										labelString: 'Trimestre'
									}
								}],
								yAxes: [{
									display: true,
									scaleLabel: {
										display: true,
										labelString: 'Creditos'
									}
								}]
							},
							title: {
								display: true,
								text: 'Grafica del avance del alumno: Esperado-Cubierto'
							}
						}
					};

					window.onload = function() {
						var ctx = document.getElementById('canvas').getContext('2d');
						window.myLine = new Chart(ctx, config);
					};
				</script>
			</fieldset>
		
		<a href="tableAccumCredits.php"  class="boton boton-verde ">Regresar Atrás</a>
		<a href="menu.php"  class="boton boton-verde ">Regresar al menú</a>
	
	</main>

<?php require 'footerView.php' ;?>