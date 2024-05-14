<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle">Actualizar producto</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$cedu = (isset($_GET['emple_id_up'])) ? $_GET['emple_id_up'] : 0;
		$cedu =limpiar_cadena($cedu);

		/*== Verificando producto ==*/
    	$check_empleado=conexion();
    	$check_empleado=$check_empleado->query("SELECT * FROM empleados WHERE emple_cedula='$cedu'");

        if($check_empleado->rowCount()>0){
        	$datos=$check_empleado->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<h2 class="title has-text-centered"><?php echo $datos['emple_nombre']; ?></h2>

	<form action="./php/empleado_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="emple_cedula" value="<?php echo $datos['emple_cedula']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Cedula</label>
				  	<input class="input" type="number" name="emple_cedula" pattern="[/^[0-9]+$/]{1,11}" maxlength="11" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="emple_nombre" pattern="[/^[\p{L}\s]+$/u]{3,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Primer Apellido</label>
				  	<input class="input" type="text" name="emple_primer_apellido" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Segundo Apellido</label>
				  	<input class="input" type="text" name="emple_segundo_apellido" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Estado</label>
				  	<input class="input" type="text" name="emple_estado" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="30" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Cargo</label>
				  	<input class="input" type="text" name="emple_cargo" pattern="[/^[\p{L}\s]+$/u]{3,30}" maxlength="30" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="text" name="emple_telefono" pattern="[/^[\p{L}\s]+$/u]{3,11}" maxlength="11" required >
				</div>
				<div class="column">
				<label>Dotacion</label><br>
		    	<div class="select is-rounded">
				  	<select name="dot_cod" >
				    	<?php
    						$categorias1=conexion();
    						$categorias1=$categorias1->query("SELECT * FROM dotaciones");
    						if($categorias1->rowCount()>0){
    							$categorias1=$categorias1->fetchAll();
    							foreach($categorias1 as $row){
    								if($datos['dot_cod']==$row['dot_cod']){
    									echo '<option value="'.$row['dot_cod'].'" selected="" >'.$row['dot_descripcion'].' (Actual)</option>';
    								}else{
    									echo '<option value="'.$row['dot_cod'].'" >'.$row['dot_descripcion'].'</option>';
    								}
				    			}
				   			}
				   			$categorias1=null;
				    	?>
				  	</select>
				</div>
				
		  	</div>
			  <div class="column">
				<label>Usuario</label><br>
		    	<div class="select is-rounded">
				  	<select name="usu_id" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	<?php
    						$categorias2=conexion();
    						$categorias2=$categorias2->query("SELECT * FROM usuarios");
    						if($categorias2->rowCount()>0){
    							$categorias2=$categorias2->fetchAll();
    							foreach($categorias2 as $row){
    								echo '<option value="'.$row['usu_id'].'" >'.$row['usu_nombre'].'</option>';
				    			}
				   			}
				   			$categorias2=null;
				    	?>
				  	</select>
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
		$check_empleado=null;
	?>
</div>