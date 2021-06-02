
<?php require 'headerView.php' ?>

	
    <main class="seccionTwo contenerdor">
		<h2 class="fw-400 text-center">Login</h2>
		<hr>

        <form class="contacto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <fieldset>
                <legend>Inicio de sesión</legend>

                <label for="user">User:</label>
                <input type="text" name="user" placeholder="User" required>

                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" required>

            </fieldset>  

            <input type="submit" value="Enviar" class="boton boton-verde">
  	 
        </form>
        
         <h2 class="error"> Los datos son incorrectos.</h2>
             
               
	</main>

<?php require 'footerView.php' ;?>