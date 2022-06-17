<?php
    require_once "../conexion.php";
    session_start();
	$usuario = $_SESSION['correo'];
	$contraseña = $_SESSION['pass'];
    $consultaempl ="SELECT idUsuario FROM usuarios where email = '$usuario' and passwordUser = '$contraseña' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasempl = mysqli_num_rows($resultadoemp);
	//Se obtienen los datos del contratante
	if($filasempl){   
		$fila=mysqli_fetch_array($resultadoemp);
		$idUsuario = $fila['idUsuario'];
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
             $sql = "SELECT idRecompensa FROM recompensa WHERE nombreRecompensa = ?";
 
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
             $sql = "SELECT idRecompensa FROM recompensa WHERE puntosCuesta = ?";
 
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
      
         $nombreimagen = $_FILES['imagen']['name'];
         $archivo = $_FILES['imagen']['tmp_name'];
         $tipoImagen = $_FILES['imagen']['type'];
         $tamImagen= $_FILES['imagen']['size'];
         $ruta = "../static/images/rewards";
         $ruta = $ruta."/".$nombreimagen;
         if($tamImagen<=1000000){
             if($tamImagen != 0){
                 if($tipoImagen == "image/jpeg" || $tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/gif"){
                     move_uploaded_file($archivo, $ruta);
                     if(empty($nombre_error) && empty($valor_error) ){
                        $sql = "INSERT INTO recompensa (nombreRecompensa, idUsuario,puntosCuesta,fechaHora,foto) VALUE (?,?,?,?,?)";            
                        if($stmt = mysqli_prepare($conexion, $sql)){
                            mysqli_stmt_bind_param($stmt, "siiss", $param_nombre, $idUsuario, $param_valor, $fechayHora,$ruta);
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
                     if($query){
                         header("location:gestionRewards.php");    
                           
                     }else{
         ?>
                         <script>
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Error',
                                 text: 'Ocurrio un erro intenta más tarde!'
                             })
                         </script>
         <?php 
                     }       
                 }else{
                     include("gestionRewards.php");   
         ?>
                     <script>
                         Swal.fire(
                             'EL ARCHIVO NO ES UNA IMAGEN!',
                             '',
                             'error'
                         )
                     </script>
     <?php       
                  }    
             }else{
                if(empty($nombre_error) && empty($valor_error) ){
                    $sql = "INSERT INTO recompensa (nombreRecompensa, idUsuario, puntosCuesta,fechaHora,foto) VALUE (?,?,?,?,?)";            
                    if($stmt = mysqli_prepare($conexion, $sql)){
                        mysqli_stmt_bind_param($stmt, "siiss", $param_nombre, $idUsuario, $param_valor, $fechayHora,$param_ruta);
                        $param_nombre = $nombre;
                        $param_valor = $valor;
                        $param_ruta = "../static/images/rewards/premio.png";
                        if(mysqli_stmt_execute($stmt)){
                            header("location:gestionRewards.php");
                        }else{
                            echo "ERROR";
                        }
                    }
                }
                 if($query){
                     header("location:gestionRewards.php");          
                 }else{
         ?>
                     <script>
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: 'Ocurrio un erro intenta más tarde!'
                          })
                     </script>
         <?php 
                     }       
             }
         }else{
             include("gestionRewards.php");    
             
             ?>
                 <script>
                     Swal.fire(
                         'EL ARCHIVO ES MUY GRANDE!',
                         '',
                         'error'
                     )
                 </script>
     <?php       
             
         }   
    
        mysqli_close($conexion);

    }
?>