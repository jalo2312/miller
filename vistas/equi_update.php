<div class="container is-fluid mb-6">
	<h1 class="title">Medicos</h1>
	<h2 class="subtitle">Actualizar Medico</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$codmed = (isset($_GET['med_id_up'])) ? $_GET['med_id_up'] : 0;
		$codmed=limpiar_cadena($codmed);

		/*== Verificando producto ==*/
    	$check_equipo=conexion();
    	$check_equipo=$check_equipo->query("SELECT * FROM medicos WHERE med_codigo='$codmed'");

        if($check_equipo->rowCount()>0){
        	$datos=$check_equipo->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<h2 class="title has-text-centered"><?php echo $datos['med_nombre']; ?></h2>

	<form action="./php/equipo_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="med_codigo" value="<?php echo $datos['med_codigo']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="med_nombre" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="30" required value="<?php echo $datos['med_nombre']; ?>">
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Apellido</label>
				  	<input class="input" type="text" name="med_apellido" pattern="[0-9]{2}[/-][0-9]{2}[/-]([0-9]{2}|[0-9]{4})" maxlength="10" required value="<?php echo $datos['med_apellido']; ?>">
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="text" name="med_telefono" pattern="[/^[\p{L}\s]+$/u]{3,150}" maxlength="150" required value="<?php echo $datos['med_telefono']; ?>">
				</div>
				</div>
				<div class="column">
		    		<div class="control">
						<label>Especialidad</label>
				  		<input class="input" type="text" name="med_especialidad" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required value="<?php echo $datos['med_especialidad']; ?>">
					</div>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_equipo=null;
	?>
</div>