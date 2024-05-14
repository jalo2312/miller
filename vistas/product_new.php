<div class="container is-fluid mb-6">
	<h1 class="title">Pacientes</h1>
	<h2 class="subtitle">Nuevo Paciente</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/producto_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		<div class="column">
		    	<div class="control">
					<label>Codigo</label>
				  	<input class="input" type="text" name="pa_codigo" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="15" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="pa_nombre" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="15" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Apellido</label>
				  	<input class="input" type="text" name="pa_apellido" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="15" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="pa_direccion" pattern="[/^[\p{L}\s]+$/u]{3,40}" maxlength="15" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Poblacion</label>
				  	<input class="input" type="text" name="pa_poblacion" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Departamento</label>
				  	<input class="input" type="text" name="pa_departamneto" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="30" required >
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="text" name="pa_telefono" pattern="[/^[\p{L}\s]+$/u]{3,11}" maxlength="10" required >
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Fecha Nacimiento</label>
				  	<input class="input" type="date" name="pa_fecha_nacimiento" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="10" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>