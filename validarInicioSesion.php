<?php
require_once "./conexion.php";
$tipoUser = $_POST['ids'];
$usuario = $_POST['correo'];
$contrasenia = $_POST['pass'];
session_start();
$_SESSION['correo'] = $usuario;
$_SESSION['pass'] = $contrasenia;
$_SESSION['tipoUser'] = $tipoUser;
$consulta = "SELECT *FROM usuarios where email = '$usuario' and passwordUser = '$contrasenia' ";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);
if($filas){
        header("location:./USER/perfilUser.php");  
}else{
    //Si no esta regisrado mandamos mensaje diciendo que las credenciales son incorrectas
    ?>
    <?php
    include("index.php");   
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Credenciales incorrectas!',
        }
)
    </script>
    <?php
      session_destroy();
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>