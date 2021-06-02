<?php require 'headerContentsView.php' ?>

	<main class="seccion registroAct">
		<h2 class="fw-400 text-center">Registro de Actividades a Tutorado </h2>
		<hr>

        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" method="POST">
            <fieldset>

                <legend>Registro de Actividades</legend>
                
                    <label for="Tutorado">Tutorado: </label>
                    <select name="matriculaTwo" class="hola">
                        <option><?php echo $resultadoDos['primerApellido'] . ' ' . $resultadoDos['segundoApellido'] . ' ' . $resultadoDos['nombre']; ?></option>
                    </select>
               
                    <label >Matricula: </label>
                    <select name="matriculaTwo" class="hola">
                        <option><?php echo $matrReg?></option>
                    </select>


                    <label>Trimestre en que se realizo la actividad: </label>
                    <select name="trimestre">
                        <option  disabled selected>-- Seleccione --</option>
                        <?php for ($i=date("Y")-4; $i<=date("Y"); $i++){ ?>
                            <option><?php echo $i . '-P'?></option>
                            <option><?php echo $i . '-I'?></option>
                            <option><?php echo $i . '-O'?></option>
                        <?php } ?>
                    </select>

                
                    <label>Elige la actividad que realizo el tutorado: </label>
                    <select name="actividadRealizar">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($resultado as $act): ?>
                            <option><?php echo $act['nombreActividad']; ?></option>
                        <?php endforeach ?>           
                    </select>

                    <label for="descripActividad">Descripcion de la actividad</label>
                    <textarea name="descripcion" class="textAreRegAct" maxlength="130" rows="5" cols="30" placeholder="Escribe la descripcion de la actividad que realizo el alumno." ></textarea>
                    <label for="comprobante">Selecciona tu comprobante </label>
                    <div class="menos">
                        <input  class="boton-file" type="file" name="subirComprobante" required>
                    </div>

                    

            </fieldset>

            <input type="submit" value="Registrar Actividad" class="boton boton-verde sin">
            
            <a href="tableActivityRegister.php"  class="boton boton-verde ">Regresar Atrás</a>

        </form>

	</main>


<?php require 'footerView.php' ;?>