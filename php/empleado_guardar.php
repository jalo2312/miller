<?php
    
    require_once "main.php";
    
    /*== Almacenando datos ==*/
    $ingcod = limpiar_cadena($_POST['ing_codigo']);
    $habitacion=limpiar_cadena($_POST['ing_habitacion']);
    $cama=limpiar_cadena($_POST['ing_cama']);
    $fechaing = isset($_POST['ing_fecha_ingreso']) ? limpiar_cadena($_POST['ing_fecha_ingreso']) : '';
    $medcod=limpiar_cadena($_POST['med_codigo']);
    $codigo = isset($_POST['pa_codigo']) ? limpiar_cadena($_POST['pa_codigo']) : '';


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$ingcod)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA CEDULA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$habitacion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    

    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$cama)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRIMER APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$fechaing)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El SEGUNDO APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Verificando usuario ==*/

	    $check_empleado=conexion();
	    $check_empleado=$check_empleado->query("SELECT ing_codigo FROM ingresos WHERE ing_codigo='$ingcod'");
	    if($check_empleado->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El EMPLEADO ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_empleado=null;
    /*== Verificando categoria ==*/
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT med_codigo FROM medicos WHERE med_codigo='$medcod'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El medico seleccionado no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;

        /*== Verificando categoria ==*/
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT pa_codigo FROM pacientes WHERE pa_codigo='$codigo'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El paciente seleccionado no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;



    /*== Guardando datos ==*/
    $guardar_empleado=conexion();
    $guardar_empleado=$guardar_empleado->prepare("INSERT INTO ingresos(ing_codigo,ing_habitacion,ing_cama,ing_fecha_ingreso,med_codigo,pa_codigo) 
    VALUES(:codeing,:habitacion,:cama,:fechaing,:medico,:paciente)");

    $marcadores=[
        ":codeing"=>$ingcod,
        ":habitacion"=>$habitacion,
        ":cama"=>$cama,
        ":fechaing"=>$fechaing,
        ":medico"=>$medcod,
        ":paciente"=>$codigo
    ];


    $guardar_empleado->execute($marcadores);

    if($guardar_empleado->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡EMPLEADO REGISTRADO!</strong><br>
                El usuario se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el empleado, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_empleado=null;