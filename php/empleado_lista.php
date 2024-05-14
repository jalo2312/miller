<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM empleados WHERE ((emple_cedula AND emple_cedula LIKE '%$busqueda%' OR emple_nombre LIKE '%$busqueda%' OR emple_primer_apellido LIKE '%$busqueda%' OR emple_segundo_apellido LIKE '%$busqueda%' OR emple_cargo LIKE '%$busqueda%')) ORDER BY emple_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(emple_cedula) FROM empleados WHERE emple_cedula AND ((emple_cedula LIKE '%$busqueda%' OR emple_primer_apellido LIKE '%$busqueda%' OR emple_segundo_apellido LIKE '%$busqueda%' OR emple_nombre LIKE '%$busqueda%' OR emple_cargo LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM empleados WHERE emple_cedula ORDER BY emple_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(emple_cedula) FROM empleados WHERE emple_cedula";
		
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>Cedula</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Estado</th>
					<th>Cargo</th>
					<th>Telefono</th>
					<th>Dotación</th>
					<th>Usuario</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$rows['emple_cedula'].'</td>
                    <td>'.$rows['emple_nombre'].'</td>
                    <td>'.$rows['emple_primer_apellido'].'</td>
                    <td>'.$rows['emple_segundo_apellido'].'</td>
                    <td>'.$rows['emple_estado'].'</td>
					<td>'.$rows['emple_cargo'].'</td>
					<td>'.$rows['emple_telefono'].'</td>
					<td>'.$rows['dot_cod'].'</td>
					<td>'.$rows['usu_id'].'</td>
                    <td>
                        <a href="index.php?vista=emple_update&emple_id_up='.$rows['emple_cedula'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&emple_id_del='.$rows['emple_cedula'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
                </tr>
            ';
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}