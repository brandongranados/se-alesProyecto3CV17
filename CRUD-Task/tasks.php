<?php
    require_once "../conexion.php";
    session_start();
    $user = $_SESSION['correo'];
    $consultauser = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$user'");
    $row = mysqli_num_rows($consultauser);
    if($row > 0){ 
        while($fila3 = mysqli_fetch_array($consultauser)) {
            $idUsuario= $fila3['idUsuario'];
        }
    }
    $nombre =$_POST['nombre'];
    $valor =$_POST['valor'];
    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
    $fechayHora = $Object->format("Y-m-d h:i:s a"); 
    $nombre = $valor = null;
    $nombre_error = $valor_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        
        //Validando nombre
        if(empty(trim($_POST["nombre"]))){
            $nombre_error = "Por favor asigne un nombre a la tarea";
         }else{
             $sql = "SELECT idTarea FROM tarea WHERE nombreTarea = ?";
 
             if($stmt = mysqli_prepare($conexion, $sql)){
                 mysqli_stmt_bind_param($stmt, "s", $param_nombre);
 
                 $param_nombre = trim($_POST["nombre"]);
 
                 if(mysqli_stmt_execute($stmt)){
                     mysqli_stmt_store_result($stmt);
                    $nombre = trim($_POST["nombre"]);
                 }else{
                     echo "Ups! Algo Salió mal, inténtalo más tarde";
                 }
             }
         }
         //Validando valor
         if(empty(trim($_POST["valor"]))){
            $valor_error = "Por favor ingrese un valor a la tarea";
         }else{
             $sql = "SELECT idTarea FROM tarea WHERE valorPuntos = ?";
 
             if($stmt = mysqli_prepare($conexion, $sql)){
                 mysqli_stmt_bind_param($stmt, "i", $param_valor);
 
                 $param_valor = trim($_POST["valor"]);
 
                 if(mysqli_stmt_execute($stmt)){
                     mysqli_stmt_store_result($stmt);
                    $valor = trim($_POST["valor"]);
                 }else{
                     echo "Ups! Algo Salió mal, inténtalo más tarde";
                 }
             }
         }
      
               
        if(empty($nombre_error) && empty($valor_error) ){
            $sql = "INSERT INTO tarea (nombreTarea,valorPuntos,fechaHora,idUsuario) VALUE (?,?,?,?)";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "sisi", $param_nombre, $param_valor, $fechayHora, $idUsuario);
                $param_nombre = $nombre;
                $param_valor = $valor;
                if(mysqli_stmt_execute($stmt)){
                    header("location:gestionTasks.php");
                }else{
                    echo "ERROR";
                }
            }
        }
        mysqli_close($conexion);

    }
?>