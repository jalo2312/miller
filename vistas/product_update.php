<div class="container is-fluid mb-6">
	<h1 class="title">Paciente</h1>
	<h2 class="subtitle">Actualizar Paciente</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$cod = (isset($_GET['pa_id_up'])) ? $_GET['pa_id_up'] : 0;
		$cod=limpiar_cadena($cod);

		/*== Verificando producto ==*/
    	$check_producto=conexion();
    	$check_producto=$check_producto->query("SELECT * FROM pacientes WHERE pa_codigo='$cod'");

        if($check_producto->rowCount()>0){
        	$datos=$check_producto->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<h2 class="title has-text-centered"><?php echo $datos['pa_nombre']; ?></h2>

	<form action="./php/producto_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="pa_codigo" value="<?php echo $datos['pa_codigo']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="pa_nombre" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="15" required value="<?php echo $datos['pa_nombre'];?>">
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Apellido</label>
				  	<input class="input" type="text" name="pa_apellido" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="15" required value="<?php echo $datos['pa_apellido'];?>">
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="pa_direccion" pattern="[/^[\p{L}\s]+$/u]{3,40}" maxlength="15" required value="<?php echo $datos['pa_direccion'];?>">
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Poblacion</label>
				  	<input class="input" type="text" name="pa_poblacion" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="100" required value="<?php echo $datos['pa_poblacion'];?>">
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Departamento</label>
				  	<input class="input" type="text" name="pa_departamneto" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="30" required value="<?php echo $datos['pa_departamneto'];?>">
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="text" name="pa_telefono" pattern="[/^[\p{L}\s]+$/u]{3,11}" maxlength="10" required value="<?php echo $datos['pa_telefono'];?>">
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Fecha Nacimiento</label>
				  	<input class="input" type="date" name="pa_fecha_nacimiento" pattern="[0-9]{2}[/-][0-9]{2}[/-]([0-9]{2}|[0-9]{4})" maxlength="10" required value="<?php echo $datos['pa_fecha_nacimiento'];?>">
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
		$check_producto=null;
	?>
</div>