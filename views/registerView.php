<?php require 'headerContentsView.php' ?>

		<main class="contenerdor registro">
		<h2 class="fw-400 text-center">Registro de Tutorado</h2>
		<hr>
           
        <form class="contacto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <fieldset>

                <legend>Información Personal</legend>

                <label for="nombre">Nombre (s):</label>
                <input type="text" name="nombre" placeholder="Nombre">

                <label for="nombre">Primer Apellido:</label>
                <input type="text" name="primerApellido" placeholder="Primer Apellido">

                <label for="nombre">Segundo Apellido:</label>
                <input type="text" name="segundoApellido" placeholder="Segundo Apellido">

			</fieldset>

            <fieldset>

                <legend>Información académica</legend>

                <!--Año de ingreso -->
                <label for="matricula">Matricula: </label>
                <input type="text" name="matricula" placeholder="Matricula">

                <label for="anioIngreso">Año de ingreso: </label>
                <select name="anioIngreso">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php for ($i=date("Y")-4; $i<=date("Y"); $i++){ ?>
                        <option><?php echo $i ?></option>
                    <?php } ?>
                </select>

                <label for="opciones"> Trimestre de ingreso: </label>
                
                <select name="trimestreIngreso" id="trimestreIngreso">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php for ($i=17; $i<=21; $i++){ ?>
                        <option><?php echo $i.'I' ?></option>
                        <option><?php echo $i.'P' ?></option>
                        <option><?php echo $i.'O' ?></option>
                    <?php } ?>
                </select>

                <label for="licenciatura">Clave de la Licenciatura: </label>
                <input type="text" name="licenciatura" placeholder="Licenciatura"> 

                <p>Seleccione si el alumno tiene o no la beca activa.</p> 

                <div class="forma-contacto">
                    <label for="becaActiva">Activa</label>
                    <input type="radio" name="beca" value="si">

                    <label for="becaNoActiva">No Activa</label>
                    <input type="radio" name="beca" value="no">

                </div>   

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                     <label for="email">E-mail</label>
	                <input type="email" name="email" placeholder="Correo electronico" required>

	                <label for="telefono">Telefono</label>
	                <input type="tel" name="telefono" placeholder="Telefono" required>

            </fieldset>

                <input  type="submit" value="Registrar" class="boton boton-verde sin">
                <a href="menu.php"  class="boton boton-verde ">Regresar Atrás</a> 
            	
        </form>
        
	
	</main>


<?php require 'footerView.php' ;?>