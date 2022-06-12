<?php
    require_once "conexion.php";
    $nombre =$_POST['nombre'];
    $valor =$_POST['valor'];   
    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
    $fechayHora = $Object->format("Y-m-d h:i:s a"); 
    $id = $_POST['idRewards'];
    $sql="UPDATE recompensa set nombreRecompensa='$nombre', puntosCuesta=$valor, fechaHora='$fechayHora' where idRecompensa=$id";
    $result=mysqli_query($conexion,$sql);
    mysqli_close($conexion);
    if($result){
        header("location:gestionRewards.php");
    }else{
        echo "No se pudo modificar la recompensa!";
    }
?>