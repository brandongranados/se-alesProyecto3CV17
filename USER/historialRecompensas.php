<?php
    require_once "../conexion.php";
    $tipoUser = $_SESSION['tipoUser'];
    $puntostotales = 0;
    //Se obtienen las tareas de sus dependientes
    $consultaemp3 ="SELECT*FROM recompensausuario where idUsuario = '$rIdContratante' and disponible ='no'";
    $resultadoemp3 = mysqli_query($conexion, $consultaemp3);
    $filasemp3 = mysqli_num_rows($resultadoemp3);    
    
    if($filasemp3 > 0){ 
    while($fila3 = mysqli_fetch_array($resultadoemp3)) {
        $idUsuario = $fila3['idUsuario'];
        $rIdTarea= $fila3['idRecompensa'];
        $rServicio=$fila3['puntosCuesta'];
        //Obtener nombre y valor de la tarea
        $consultaempl ="SELECT * FROM recompensa where idRecompensa='$rIdTarea' ";
        $resultadoemp = mysqli_query($conexion, $consultaempl);
        $filasempl = mysqli_num_rows($resultadoemp);

        if($filasempl){   
            $fila=mysqli_fetch_array($resultadoemp);
            $rNombreS= $fila['nombreRecompensa'];
            $rPrecioS= $fila['puntosCuesta'];
        }
        echo "<div class='mb-3'>";
            echo "<p id='$rIdTarea'>Recompensa: $rNombreS <br>
                                       Estatus: Reclamada  <br>
                                       Costo de la recompensa: $rPrecioS</p>";
                                       $tipo='"'."solicitud".'"';
            echo "<hr> </div>";
        }
    }
    else
    echo "<p>No hay Tareas activas</p>";

    ?>