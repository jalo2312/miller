<?php

	require_once "main.php";

	/*== Almacenando datos ==*/
    $codigo=limpiar_cadena($_POST['pa_codigo']);
	$nombre=limpiar_cadena($_POST['pa_nombre']);
	$apellido=limpiar_cadena($_POST['pa_apellido']);
	$direccion=limpiar_cadena($_POST['pa_direccion']);
    $poblacion=limpiar_cadena($_POST['pa_poblacion']);
    $departamento=limpiar_cadena($_POST['pa_departamneto']);
    $telefono=limpiar_cadena($_POST['pa_telefono']);
    $fecha=limpiar_cadena($_POST['pa_fecha_nacimiento']);

	/*== Verificando campos obligatorios ==*/
    if($codigo=="" || $nombre=="" || $apellido=="" || $direccion=="" || $poblacion=="" || $departamento=="" || $telefono=="" || $fecha==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA DESCRIPCION no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,100}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA DESCRIPCION no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El ESTADO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$direccion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA FECHA DE ENTRADA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$poblacion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA FECHA DE ENTREGA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$departamento)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA FECHA DE ENTREGA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$telefono)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA FECHA DE ENTREGA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$fecha)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA FECHA DE ENTREGA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    $check_codigo=conexion();
    $check_codigo=$check_codigo->query("SELECT pa_codigo FROM pacientes WHERE pa_codigo='$codigo'");
    if($check_codigo->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_codigo=null;


	/*== Guardando datos ==*/
    $guardar_producto=conexion();
    $guardar_producto=$guardar_producto->prepare("INSERT INTO pacientes(pa_codigo,pa_nombre,pa_apellido,pa_direccion,pa_poblacion,pa_departamneto,pa_telefono,pa_fecha_nacimiento) 
    VALUES(:codigo,:nombre,:apellido,:direccion,:poblacion,:departamento,:telefono,:fecha)");

    $marcadores=[
    ":codigo"=>$codigo,
    ":nombre"=>$nombre,
    ":apellido"=>$apellido,
    ":direccion"=>$direccion,
    ":poblacion"=>$poblacion,
    ":departamento"=>$departamento,
    ":telefono"=>$telefono,
    ":fecha"=>$fecha
    ];

    $guardar_producto->execute($marcadores);

    if($guardar_producto->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡HERRAMIENTA REGISTRADA!</strong><br>
                El paciente se registro con exito
            </div>
        ';
    }else{
        echo '
        <div class="notification is-info is-light">
            <strong>¡EROR NO SE RISTRO !</strong><br>
        </div>
    ';
    }
    $guardar_producto=null;
   
