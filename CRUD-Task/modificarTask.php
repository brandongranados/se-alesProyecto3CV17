<?php
    require_once "../conexion.php";
    $nombre =$_POST['nombre'];
    $valor =$_POST['valor'];   
    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
    $fechayHora = $Object->format("Y-m-d h:i:s a"); 
    $id = $_POST['idTasks'];
    $sql="UPDATE tarea set nombreTarea='$nombre', valorPuntos=$valor, fechaHora='$fechayHora' where idTarea=$id";
    $result=mysqli_query($conexion,$sql);
    mysqli_close($conexion);
    if($result){
        header("location:gestionTasks.php");
    }else{
        echo "No se pudo modificar el servicio!";
    }
?>