<?php
    require_once "../inc/session_start.php";
	require_once "main.php";

	/*== Almacenando id ==*/
    $codigo=limpiar_cadena($_POST['pa_codigo']);


    /*== Verificando producto ==*/
	$check_producto=conexion();
	$check_producto=$check_producto->query("SELECT * FROM pacientes WHERE pa_codigo='$codigo'");

    if($check_producto->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El herramienta no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_producto->fetch();
    }
    $check_producto=null;


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



    /*== Actualizando datos ==*/
    $actualizar_producto=conexion();
    $actualizar_producto=$actualizar_producto->prepare("UPDATE pacientes SET pa_codigo=:codigo,pa_nombre=:nombre,pa_apellido=:apellido,pa_direccion=:direccion,pa_poblacion=:poblacion,pa_departamneto=:departamento,pa_telefono=:telefono,pa_fecha_nacimiento=:fecha WHERE pa_codigo=:codigo");

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

    if($actualizar_producto->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡HERRAMIENTA ACTUALIZADA!</strong><br>
                El producto se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la herramienta, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_producto=null;