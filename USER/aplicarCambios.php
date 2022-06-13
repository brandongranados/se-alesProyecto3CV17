<?php
session_start();
$usuario = $_SESSION['correo'];
    require_once "../conexion.php";
    $nombre =$_POST['nombre'];
    $nombreimagen = $_FILES['imagen']['name'];
    $archivo = $_FILES['imagen']['tmp_name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamImagen= $_FILES['imagen']['size'];
    $ruta = "../static/images/perfil";
    
    $usuario = $_SESSION['correo'];
    
    $ruta = $ruta."/".$nombreimagen;
    if($tamImagen<=1000000){
        if($tamImagen != 0){
            if($tipoImagen == "image/jpeg" || $tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/gif"){
                move_uploaded_file($archivo, $ruta);
    
                $query = mysqli_query($conexion,"UPDATE usuarios set nombreUsuario = '$nombre',foto='$ruta' where email='$usuario'");
                mysqli_close($conexion);
                if($query){
                    header("location:./perfilUser.php");    
                      
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
                include("modifContratante.php");   
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
            $query = mysqli_query($conexion,"UPDATE usuarios set nombreUsuario = '$nombre' where email='$usuario'");
            mysqli_close($conexion);
            if($query){
                header("location:./perfilUser.php");          
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
        include("modificarUser.php");    
        
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