<?php
    require_once "conexion.php";
    
    //Definir Variables
    $username = $email = $contra = $contra1 = "";
    $username_error = $email_error = $contra_error = $contra1_error = "";

     if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Validando nombre
    /*    if(empty(trim($_POST["nombre"]))){
            $username_error = "Por favor ingrese su nombre";
        }else{
            $sql = "SELECT usuario FROM usuarios WHERE nombre = ?";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["nombre"]);

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    $username = trim($_POST["nombre"]);
                }else{
                    echo "Ups! Algo Salió mal, inténtalo más tarde";
                }
            }
        }*/
        
        //Validando email
        if(empty(trim($_POST["email"]))){
            $email_error = "Por favor ingrese su correo electr&oacute;nico";
        }else{
            $sql = "SELECT email FROM usuarios WHERE email = ?";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                $param_tel = trim($_POST["email"]);

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $email_error = "Este correo electr&oacute;nico ya está en uso";
                    }else{
                        $email = trim($_POST["email"]);
                    }
                }else{
                    echo "Ups! Algo Salió mal, inténtalo más tarde";
                }
            }
        }
        //Validando Contraseña
        if(empty(trim($_POST["pass"]))){
            $contra_error = "Por favor, ingrese una contraseña";
        }elseif(strlen(trim($_POST["pass"])) < 5){
            $contra_error = "La contraseña debe de tener al menos 5 caracteres";
        }else{
            $contra = trim($_POST["pass"]); 
        }
        //Validando Contraseña1
        if(empty(trim($_POST["pass1"]))){
            $contra1_error = "Por favor, ingrese una contraseña";
        }elseif(strlen(trim($_POST["pass1"])) < 5){
            $contra1_error = "La contraseña debe de tener al menos 5 caracteres";
        }else{
            $contra1 = trim($_POST["pass1"]); 
        }
        //Comprobando contraseñas
        if($contra == $contra1){

        }else{
            $contra_error =   "Las contraseñas no coinciden";
        }
        
        if(empty($username_error) && empty($email_error) && empty($contra_error) && empty($contra1_error)){
            $sql = "INSERT INTO usuarios ( passwordUser, email) VALUE (?,?)";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "ss", $param_contra, $param_email);
                $param_username = $username;
                $param_contra = $contra;
                $param_email = $email;
                if(mysqli_stmt_execute($stmt)){
                    header("location:index.php");
                }else{
                    echo "ERROR";
                }
            }
        }
        mysqli_close($conexion);

    }
?>