<?php
    require_once "../conexion.php";
    $tipoUser = $_SESSION['tipoUser'];
    //Se obtienen las tareas de sus dependientes
    if($tipoUser == "Usuario"){
        $consultaemp3 ="SELECT*FROM tarearealizada where idUsuario = '$rIdContratante' and estatus ='activo'";
        $resultadoemp3 = mysqli_query($conexion, $consultaemp3);
        $filasemp3 = mysqli_num_rows($resultadoemp3);    
    }else{
        $consultaemp3 ="SELECT * FROM usuariodependiente ud JOIN tarearealizada tr ON ud.idUsuarioDep = tr.idUsuario  WHERE ud.idUsuario =  '$rIdContratante' and tr.estatus = 'activo'";
        $resultadoemp3 = mysqli_query($conexion, $consultaemp3);
        $filasemp3 = mysqli_num_rows($resultadoemp3);    
    }
    
    if($filasemp3 > 0){ 
    while($fila3 = mysqli_fetch_array($resultadoemp3)) {
        $idUsuario = $fila3['idUsuario'];
        $rIdTarea= $fila3['idTarea'];
        $rServicio=$fila3['avancePuntos'];
        $rEstatus=$fila3['estatus'];
        //Obtener nombre del empleado
        if($tipoUser == "Admin"){
            $consultaempl ="SELECT * FROM usuarios where idUsuario='$idUsuario' ";
            $resultadoemp = mysqli_query($conexion, $consultaempl);
            $filasempl = mysqli_num_rows($resultadoemp);
        }else{
            $consultaempl ="SELECT u.nombreUsuario FROM usuarios u JOIN tarea t ON u.idUsuario = t.idUsuario WHERE t.idTarea = '$rIdTarea' ";
            $resultadoemp = mysqli_query($conexion, $consultaempl);
            $filasempl = mysqli_num_rows($resultadoemp);
        }
        if($filasempl){   
            $fila=mysqli_fetch_array($resultadoemp);
            $rNombreC= $fila['nombreUsuario'];
        }
        //Obtener nombre y valor de la tarea
        $consultaempl ="SELECT * FROM tarea where idTarea='$rIdTarea' ";
        $resultadoemp = mysqli_query($conexion, $consultaempl);
        $filasempl = mysqli_num_rows($resultadoemp);

        if($filasempl){   
            $fila=mysqli_fetch_array($resultadoemp);
            $rNombreS= $fila['nombreTarea'];
            $rPrecioS= $fila['valorPuntos'];
        }
        echo "<div class='mb-3'>";
        if($tipoUser == "Admin"){
            echo "<p id='$rIdTarea'>Tarea: $rNombreS <br>
                                       Usuario: $rNombreC <br>
                                       Estatus: $rEstatus  <br>
                                       Valor de la tarea: $rPrecioS</p>";
                                       $tipo='"'."solicitud".'"';
            echo "<hr> </div>";
            echo "<input  type='button' class='btn btn-primary' value='Revisar solicitud' onClick='alertar($rIdTarea,$tipo);'>";
        }else{
            echo "<p id='$rIdTarea'>Tarea: $rNombreS <br>
                                       Usuario Admin: $rNombreC <br>
                                       Estatus: $rEstatus  <br>
                                       Valor de la tarea: $rPrecioS</p>";
                                       $tipo='"'."solicitud".'"';
            echo "<hr> </div>";
        }
      }
    }
    else
    echo "<p>No hay Tareas activas</p>";

    ?>