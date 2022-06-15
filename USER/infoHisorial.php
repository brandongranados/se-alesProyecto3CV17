<?php
if (isset($_POST['IdTarea'])) {
    require_once "../conexion.php";
    $id = $_POST['IdTarea'];

    $consultaempl ="SELECT*FROM tarearealizada where idTarea='$id' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasempl = mysqli_num_rows($resultadoemp);

    if($filasempl){   
		$fila=mysqli_fetch_array($resultadoemp);
		$idTarea = $fila['idTarea'];
        $idUsuario = $fila['idUsuario'];
        $idPuntos = $fila['avancePuntos'];
        $idFechaI = $fila['fecha_inicio'];
        $idFechaF = $fila['fecha_fin'];
    }

    $consultaempl ="SELECT*FROM usuarios where idUsuarios='$idUsuario' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasemp2 = mysqli_num_rows($resultadoemp);

    if($filasemp2 > 0){ 
        $fila=mysqli_fetch_array($resultadoemp);
		$nombreC= $fila['nombreUsuario'];
        $emailC= $fila['email'];
    }

    $consultaempl ="SELECT*FROM tarea where idTarea='$idTarea' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasemp3 = mysqli_num_rows($resultadoemp);

    if($filasemp3 > 0){ 
        $fila=mysqli_fetch_array($resultadoemp);
		$nombreS= $fila['nombreTarea'];
        $precioS= $fila['valorPuntos'];
    }

    $texto="Servicio: ".$nombreS."<br>"."Empleado: ".$nombreC."<br>"."Email: ".$emailC."<br>"."Precio: $".$precioS;

echo $texto;
} 
else {
    echo 2;
}   
?>