<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

    /*== Almacenando id ==*/
    $cedu=limpiar_cadena($_POST['emple_cedula']);

    /*== Verificando usuario ==*/
	$check_empleado=conexion();
	$check_empleado=$check_empleado->query("SELECT * FROM empleados WHERE emple_cedula ='$cedu'");

    if($check_empleado->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Empleado no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_empleado->fetch();
    }
    $check_empleado=null;


    
    /*== Almacenando datos del usuario ==*/
    $cedula = limpiar_cadena($_POST['emple_cedula']);
    $nombre=limpiar_cadena($_POST['emple_nombre']);
    $primerapellido=limpiar_cadena($_POST['emple_primer_apellido']);

    $segundoapellido=limpiar_cadena($_POST['emple_segundo_apellido']);
    $estado=limpiar_cadena($_POST['emple_estado']);

    $cargo=limpiar_cadena($_POST['emple_cargo']);
    $telefono=limpiar_cadena($_POST['emple_telefono']);
    $categoria1=limpiar_cadena($_POST['dot_cod']);
    $categoria2=limpiar_cadena($_POST['usu_id']);


    /*== Verificando campos obligatorios del usuario ==*/
    if($cedula=="" ||$nombre=="" || $primerapellido=="" || $segundoapellido==""|| $estado==""||$cargo=="" || $telefono==""|| $categoria1== ""|| $categoria2==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos (usuario) ==*/
    if(verificar_datos("[/^[0-9]+$/]{1,11}",$cedula)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                LA CEDULA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,100}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    

    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,50}",$primerapellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRIMER APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,50}",$segundoapellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El SEGUNDO APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$estado)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El ESTADO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$cargo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CARGO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[0-9]+$/]{3,11}",$telefono)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El TELEFONO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


   
    /*== Verificando categoria ==*/
    if($categoria!=$datos['dot_cod']){
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT dot_cod FROM dotaciones WHERE dot_cod='$categoria1'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La categoría CODIGO seleccionada no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;
    }
    if($categoria!=$datos['usu_id']){
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT usu_id FROM usuarios WHERE usu_id='$categoria2'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La categoría USUARIO seleccionada no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;
    }


    /*== Actualizar datos ==*/
    $actualizar_empleado=conexion();
    $actualizar_empleado=$actualizar_empleado->prepare("UPDATE empleados SET emple_cedula=:cedula,emple_nombre=:nombre,emple_primer_apellido=:primer_apellido,emple_segundo_apellido=:segundo_apellido,emple_estado=:estado,emple_cargo=:cargo,emple_telefono=:telefono, dot_cod=:categoria1, usu_id=:categoria2 WHERE emple_cedula=:cedu");

    $marcadores=[
        ":cedula"=>$cedula,
        ":nombre"=>$nombre,
        ":primer_apellido"=>$primerapellido,
        ":segundo_apellido"=>$segundoapellido,
        ":estado"=>$estado,
        ":cargo"=>$cargo,
        ":telefono"=>$telefono,
        ":categoria1"=>$categoria1,
        ":categoria2"=>$categoria2,
        ":cedu"=>$cedula
    ];

    if($actualizar_empleado->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡EMPLEADO ACTUALIZADO!</strong><br>
                El usuario se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el empleado, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_empelado=null;