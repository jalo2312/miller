<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM medicos WHERE ((med_codigo  AND med_codigo  LIKE '%$busqueda%' OR med_nombre LIKE '%$busqueda%' OR med_apellido LIKE '%$busqueda%' OR med_telefono LIKE '%$busqueda%' OR med_especialidad LIKE '%$busqueda%')) ORDER BY med_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(med_codigo ) FROM medicos WHERE med_codigo  AND ((med_codigo  LIKE '%$busqueda%' OR med_nombre LIKE '%$busqueda%' OR med_apellido LIKE '%$busqueda%' OR med_telefono LIKE '%$busqueda%' OR med_especialidad LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM medicos WHERE med_codigo  ORDER BY med_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(med_codigo ) FROM medicos WHERE med_codigo ";
		
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
                	<th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
					<th>Especialidad</th>
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
					<td>'.$rows['med_codigo'].'</td>
                    <td>'.$rows['med_nombre'].'</td>
                    <td>'.$rows['med_apellido'].'</td>
					<td>'.$rows['med_telefono'].'</td>
					<td>'.$rows['med_especialidad'].'</td>
                    <td>
					<a href="index.php?vista=equi_update&med_id_up='.$rows['med_codigo'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
					<a href="'.$url.$pagina.'&med_id_del='.$rows['med_codigo'].'" class="button is-danger is-rounded is-small">Eliminar</a>
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
		$tabla.='<p class="has-text-right">Mostrando Equipos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}