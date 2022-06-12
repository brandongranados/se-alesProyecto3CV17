<?php
    require_once "../conexion.php";
    $nombre =$_POST['nombre'];
    $valor =$_POST['valor'];   
    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
    $fechayHora = $Object->format("Y-m-d h:i:s a"); 
    $id = $_POST['idRewards'];
    $nombreimagen = $_FILES['imagen']['name'];
    $archivo = $_FILES['imagen']['tmp_name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamImagen= $_FILES['imagen']['size'];
    $ruta = "../static/images/rewards";
    $usuario = $_SESSION['correo'];
    $ruta = $ruta."/".$nombreimagen;
    if($tamImagen<=1000000){
        if($tamImagen != 0){
            if($tipoImagen == "image/jpeg" || $tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/gif"){
                move_uploaded_file($archivo, $ruta);
    
                $query = mysqli_query($conexion,"UPDATE recompensa set nombreRecompensa='$nombre', puntosCuesta=$valor, fechaHora='$fechayHora', foto='$ruta' where idRecompensa=$id");
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
            $query = mysqli_query($conexion,"UPDATE recompensa set nombreRecompensa='$nombre', puntosCuesta=$valor, fechaHora='$fechayHora' where idRecompensa=$id");
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
    if($result){
        header("location:gestionRewards.php");
    }else{
        echo "No se pudo modificar la recompensa!";
    }
?>