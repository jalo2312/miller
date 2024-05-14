<div class="container is-fluid mb-6">
	<h1 class="title">Ingresos</h1>
	<h2 class="subtitle">Nuevo Ingreso</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/empleado_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Codigo</label>
				  	<input class="input" type="number" name="ing_codigo" pattern="[/^[0-9]+$/]{1,11}" maxlength="11" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Habitacion</label>
				  	<input class="input" type="text" name="ing_habitacion" pattern="[/^[\p{L}\s]+$/u]{3,100}" maxlength="100" required >
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Cama</label>
				  	<input class="input" type="text" name="ing_cama" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Fecha Ingreso</label>
				  	<input class="input" type="date" name="ing_fecha_ingreso" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required >
				</div>
		  	</div>
			<div class="column">
				<label for="">Medico</label><br>
				<div class="select is-rounded">
					<select name="med_codigo">
						<option value="" selected="">Seleccione un medico
							<?php 
								$categorias=conexion();
								$categorias=$categorias->query("SELECT * FROM medicos");
								if($categorias->rowCount()>0){
									$categorias=$categorias->fetchAll();
									foreach($categorias as $row){
										echo '<option value="'.$row['med_codigo'].'" >'.$row['med_nombre'].'</option>';
									}
								   }
								   $categorias=null;
							?>
						</option>
					</select>
				</div>

			</div>
			
			  <div class="column">
				<label>Paciente</label><br>
		    	<div class="select is-rounded">
				  	<select name="usu_id" >
				    	<option value="" selected="">Seleccione un paciente</option>
				    	<?php
    						$categorias=conexion();
    						$categorias=$categorias->query("SELECT * FROM pacientes");
    						if($categorias->rowCount()>0){
    							$categorias=$categorias->fetchAll();
    							foreach($categorias as $row){
    								echo '<option value="'.$row['pa_codigo'].'" >'.$row['pa_nombre'].'</option>';
				    			}
				   			}
				   			$categorias=null;
				    	?>
				  	</select>
				</div>
		  	</div>
			
			
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>