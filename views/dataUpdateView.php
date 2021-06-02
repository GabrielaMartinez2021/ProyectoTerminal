
<?php require 'headerView.php' ?>
    
    <div>
	
    <main class="seccionTwo contenerdor cort">
		<h2 class="fw-400 text-center">Actualización</h2>
		<hr>

        <form class="contacto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <fieldset>
                <legend></legend>
                    <input type="submit" value="Actializar Trimestre" class="boton boton-azul larg">
            </fieldset>  
 
        </form>

        <div class="error">
            <p><?php echo $error; ?></p>
         </div> 
             
               
	</main>
    </div>

<?php require 'footerView.php' ;?>
