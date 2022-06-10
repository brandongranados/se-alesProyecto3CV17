<?php 
    $conexion = mysqli_connect("localhost", "root","","actividades");
    if($conexion === false){
        die("ERROR EN LA CONEXION" . mysqli_connect_error());
    }
?>