<?php
    require_once "conexion.php";
    session_start();
	$usuario = $_SESSION['correo'];
	$contraseña = $_SESSION['pass'];
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
             $sql = "SELECT idRecompensa FROM recompesa WHERE nombreRecompensa = ?";
 
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
             $sql = "SELECT idRecompensa FROM recompesa WHERE valorPuntos = ?";
 
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
            $sql = "INSERT INTO recompensa (nombreRecompensa,puntosCuesta,fechaHora) VALUE (?,?,?)";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "sis", $param_nombre, $param_valor, $fechayHora);
                $param_nombre = $nombre;
                $param_valor = $valor;
                if(mysqli_stmt_execute($stmt)){
                    header("location:gestionRewards.php");
                }else{
                    echo "ERROR";
                }
            }
        }
        mysqli_close($conexion);

    }
?>