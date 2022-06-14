<?php 
	require_once "../conexion.php";
	$id = $_POST['idTasks'];
	$sql="DELETE from usuariodependiente where idUsuarioDep = $id";
	$result=mysqli_query($conexion,$sql);
    mysqli_close($conexion);
    if($result){
        header("location:gestionUsuario.php");
    }else{
        echo "NO SE PUDO ELIMINAR LA TAREA";
    }
 ?>