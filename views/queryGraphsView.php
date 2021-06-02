<?php require 'headerGraphicsView.php' ?>
	<main class="seccion graficas">
		<h2 class="fw-400 text-center">Consulta de gráficas</h2>
		<hr>

			<fieldset>
	            <legend>Grafica del avance de los alumnos</legend>
					<div class="graf">
						<canvas id="canvas"></canvas>
					</div>
				<script>

					var datosDosjs = <?php echo json_encode($arregloMatriculas);?>;
					var titulo =[];
					

					var credReal = <?php echo json_encode($arregloVista);?>;
					var cred = new Array(3);

					var dataColorjs = <?php echo json_encode($colores);?>;
					var color =[];

					for (var i = 0; i < dataColorjs.length; i++) {
						color.push(dataColorjs[i]);
					}

					for (var i = 0; i < datosDosjs.length; i++) {
						titulo.push(datosDosjs[i]);
					}


					
					lineChartData = {type: 'line',
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
								text: 'Grafica del avance de los alumnos: Esperado-Cubierto'
							}
						}}; //declare an object
					
					lineChartData.data = { labels:[
							<?php for ($i=0; $i <=12 ; $i++){ ?>
           					'<?php echo $i; ?>',
            				<?php } ?>]	
						}; //add 'datasets' array element to object
			
						
            		lineChartData.data.datasets=[{
								label: 'Esperado',
								data: [0,
									<?php for ($i=0; $i <12 ; $i++){ ?>
           					'<?php echo  $datos[0][$i]; ?>',
            				<?php } ?>
								],
								backgroundColor:"rgba(255, 87, 51, 0.5)",
								borderColor:"rgba(255, 87, 51, 0.5)" ,
								fill: false,
								pointRadius: [6,6,6,6,6,6,6,6,6,6,6,6,6],
							},];
            		for (var i = 0; i <titulo.length; i++) {

							lineChartData.data.datasets.push({label: titulo[i],
								data:  credReal[i],
								backgroundColor:color[i],
								borderColor:color[i] ,
								fill: false,
								borderDash: [5, 5],
								pointRadius: [10,10,10,10,10,10,10,10,10,10,10,10,10],});
							
						}



					window.onload = function() {
						var ctx = document.getElementById('canvas').getContext('2d');
						window.myLine = new Chart(ctx, lineChartData);
					};
	
				</script>
			</fieldset>
			<fieldset>
	            <legend>Estadistica de los alumnos con beca y sin beca</legend>
					<div class="graf">
						<canvas id="canvas1"></canvas>
					</div>
				<script>

					var ctxNew = document.getElementById('canvas1').getContext('2d');
			var myBarNew = new Chart(ctxNew, {
				type: 'bar',
				data: {
			labels: ['Beca Activa','Beca no Activa'],
			datasets: [{
				label: 'Alumnos Activos',
				data: [<?php echo $varSi ?>,<?php echo $varNo?>],
				backgroundColor: "rgba(23, 229, 207,0.5)",
				borderColor: "rgba(23, 229, 207,0.5)",
				borderWidth: 1	
				}]
			},
				options : {
			    scales: {
			        yAxes: [{
			            ticks: {
			                beginAtZero: true
			            }
			        }],
			        xAxes: [{
			            ticks: {
			                beginAtZero: true
			            		}
			        		}]
			    	},title: {
								display: true,
								text: 'Estadistica de los alumnos con beca y sin beca: Activos'
							}
				}
			});
					
	
				</script>
			</fieldset>

		<a href="menu.php"  class="boton boton-verde ">Regresar al menú</a>
		<button class="boton boton-verde" onclick="window.print()">Imprimir Página</button>
	
	</main>

<?php require 'footerView.php' ;?>