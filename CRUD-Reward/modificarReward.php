<?php
    require_once "../conexion.php";
    $nombre =$_POST['nombre'];
    $valor =$_POST['valor'];   
    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
    $fechayHora = $Object->format("Y-m-d h:i:s a"); 
    $id = $_POST['idRewards'];
    $usuarios =$_POST['usuarios'];
    $nombreimagen = $_FILES['imagen']['name'];
    $archivo = $_FILES['imagen']['tmp_name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamImagen= $_FILES['imagen']['size'];
    $ruta = "../static/images/rewards";
    $ruta = $ruta."/".$nombreimagen;
    foreach($usuarios as $usuarioslist){        
        $comprobar = mysqli_query($conexion, "SELECT *FROM recompensausuario WHERE idRecompensa = '$id'  and idUsuario = '$usuarioslist'");
        $row = mysqli_fetch_array($comprobar);
        if(empty($row)){
            $query = "INSERT INTO recompensausuario VALUES ('$id','$usuarioslist')";
            $query_run = mysqli_query($conexion, $query);
        }
    }
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
?>