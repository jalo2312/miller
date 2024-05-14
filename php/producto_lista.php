<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM pacientes WHERE ((pa_codigo  AND pa_codigo LIKE '%$busqueda%' OR pa_nombre LIKE '%$busqueda%' OR pa_apellido LIKE '%$busqueda%'OR pa_direccion LIKE '%$busqueda%' OR pa_poblacion LIKE '%$busqueda%' OR pa_departamneto LIKE '%$busqueda%' OR pa_telefono LIKE '%$busqueda%' OR pa_fecha_nacimiento LIKE '%$busqueda%')) ORDER BY pa_nombre  ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(pa_codigo) FROM pacientes WHERE pa_codigo AND ((pa_codigo LIKE '%$busqueda%' OR pa_nombre LIKE '%$busqueda%' OR pa_apellido LIKE '%$busqueda%'OR pa_direccion LIKE '%$busqueda%' OR pa_poblacion LIKE '%$busqueda%' OR pa_departamneto LIKE '%$busqueda%' OR pa_telefono LIKE '%$busqueda%' OR pa_fecha_nacimiento LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM pacientes WHERE pa_codigo ORDER BY pa_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(pa_codigo) FROM pacientes WHERE pa_codigo";
		
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
                	<th>#Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
					<th>Poblacion</th>
					<th>Departamento</th>
					<th>Telefono</th>
					<th>Fecha Nacimiento</th>
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
					<td>'.$rows['pa_codigo'].'</td>
                    <td>'.$rows['pa_nombre'].'</td>
                    <td>'.$rows['pa_apellido'].'</td>
                    <td>'.$rows['pa_direccion'].'</td>
					<td>'.$rows['pa_poblacion'].'</td>
					<td>'.$rows['pa_departamneto'].'</td>
					<td>'.$rows['pa_telefono'].'</td>
					<td>'.$rows['pa_fecha_nacimiento'].'</td>
                    <td>
					<a href="index.php?vista=product_update&pa_id_up='.$rows['pa_codigo'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
					<a href="'.$url.$pagina.'&pa_id_del='.$rows['pa_codigo'].'" class="button is-danger is-rounded is-small">Eliminar</a>
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