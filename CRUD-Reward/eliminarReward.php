<?php 
	require_once "../conexion.php";
	$id = $_POST['idRewards'];
	$sql="DELETE from recompensa where idRecompensa = $id";
	$result=mysqli_query($conexion,$sql);
    mysqli_close($conexion);
    if($result){
        header("location:gestionRewards.php");
    }else{
        echo "NO SE PUDO ELIMINAR LA RECOMPENSA";
    }
 ?>