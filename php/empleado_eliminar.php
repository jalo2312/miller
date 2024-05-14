<?php
	/*== Almacenando datos ==*/
    $emple_id_del=limpiar_cadena($_GET['emple_id_del']);

    /*== Verificando producto ==*/
    $check_empleado=conexion();
    $check_empleado=$check_empleado->query("SELECT * FROM empleados WHERE emple_cedula='$emple_id_del'");

    if($check_empleado->rowCount()==1){

    	$datos=$check_empleado->fetch();

    	$eliminar_empleado=conexion();
    	$eliminar_empleado=$eliminar_empleado->prepare("DELETE FROM empleados WHERE emple_cedula=:cedu");

    	$eliminar_empleado->execute([":cedu"=>$emple_id_del]);

    	if($eliminar_empleado->rowCount()==1){
	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡EMPLEADO ELIMINADO!</strong><br>
	                Los datos del producto se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el empleado, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_empleado=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El EMPLEADO que intenta eliminar no existe
            </div>
        ';
    }
    $check_empleado=null;