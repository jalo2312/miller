<div class="container is-fluid mb-6">
	<h1 class="title">Medicos</h1>
	<h2 class="subtitle">Nuevo Medico</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/equipo_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Codigo</label>
				  	<input class="input" type="text" name="med_codigo" pattern="[/^[\p{L}\s]+$/u]{1,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="med_nombre" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="30" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Apellido</label>
				  	<input class="input" type="text" name="med_apellido" pattern="[0-9]{2}[/-][0-9]{2}[/-]([0-9]{2}|[0-9]{4})" maxlength="10" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="text" name="med_telefono" pattern="[/^[\p{L}\s]+$/u]{3,150}" maxlength="150" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Especialidad</label>
				  	<input class="input" type="text" name="med_especialidad" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>