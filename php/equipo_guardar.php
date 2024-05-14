<?php

	require_once "main.php";

	/*== Almacenando datos ==*/
	$medcod=limpiar_cadena($_POST['med_codigo']);
	$mednombre=limpiar_cadena($_POST['med_nombre']);
	$medapellido=limpiar_cadena($_POST['med_apellido']);
	$medtelefono=limpiar_cadena($_POST['med_telefono']);
    $especialidad=limpiar_cadena($_POST['med_especialidad']);
    

	/*== Verificando campos obligatorios ==*/
    if($medcod=="" || $mednombre=="" || $medapellido==""|| $medtelefono=="" || $especialidad==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,50}",$medcod)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El SERIAL no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$mednombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NUMERO DE SALIDA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{2}[/-][0-9]{2}[/-]([0-9]{2}|[0-9]{4})",$medapellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA FECHA DE ENTREGA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,150}",$medtelefono)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA DESCRIPCION no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,50}",$especialidad)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA ESTADO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Verificando serial ==*/

	    $check_serial=conexion();
	    $check_serial=$check_serial->query("SELECT med_codigo  FROM medicos WHERE med_codigo ='$medcod'");
	    if($check_serial->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El SERIAL ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_serial=null;

	/*== Guardando datos ==*/
    $guardar_equipo=conexion();
    $guardar_equipo=$guardar_equipo->prepare("INSERT INTO medicos(med_codigo,med_nombre,med_apellido,med_telefono,med_especialidad) 
    VALUES(:medcodigo,:nombremed,:apellidomed,:telefonomed,:especialidad)");

    $marcadores=[
        ":medcodigo"=>$medcod,
        ":nombremed"=>$mednombre,
        ":apellidomed"=>$medapellido,
        ":telefonomed"=>$medtelefono,
        ":especialidad"=>$especialidad
    ];
    

    $guardar_equipo->execute($marcadores);

    if($guardar_equipo->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡EQUIPO REGISTRADO!</strong><br>
                El equipo se registro con exito
            </div>
        ';
    }else{
        echo '
        <div class="notification is-info is-light">
            <strong>¡EROR NO SE RISTRO!</strong><br>
        </div>
    ';
    }
    $guardar_equipo=null;
   
