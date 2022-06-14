<?php
    require_once "../conexion.php";
    session_start();
    $user = $_SESSION['correo'];
    $nombre =$_POST['nombre'];
    $consultauser = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$user'");
    $row = mysqli_num_rows($consultauser);
    if($row > 0){ 
        while($fila3 = mysqli_fetch_array($consultauser)) {
            $idUsuario= $fila3['idUsuario'];
        }
    }
    $consultadep = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$nombre'");
    $raw = mysqli_num_rows($consultadep);
    if($raw > 0){ 
        while($fila2 = mysqli_fetch_array($consultadep)) {
            $idUsuarioDep= $fila2['idUsuario'];
        }
    }else{
        $idUsuarioDep= NULL;
    }
    $consul = mysqli_query($conexion, "SELECT * FROM usuariodependiente WHERE idUsuario = '$idUsuario' and idUsuarioDep = '$idUsuarioDep'");
    $rew = mysqli_num_rows($consul);
    $idUsuario_error = $idUsuarioDep_error = NULL;
    if($idUsuario == $idUsuarioDep){
        $idUsuarioDep_error =   "No puedes agregar este usuario";
    }elseif($idUsuarioDep == NULL){
        $idUsuarioDep_error =   "El usuario no existe";
    }elseif($rew > 0){
        $idUsuarioDep_error =   "El usuario ya existe";
    }
    if(empty($idUsuarioDep_error)){
        $sql = "INSERT INTO usuariodependiente (idUsuario,idUsuarioDep) VALUE ('$idUsuario','$idUsuarioDep')";
        $stmt = mysqli_prepare($conexion, $sql);
        if(mysqli_stmt_execute($stmt)){
            header("location:gestionUsuario.php");
        }else{
            echo "ERROR";
        }
    }else{
        include("gestionUsuario.php");   
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El Correo no es Valido o ya tiene agregado a este usuario!',
        }
)
    </script>
    <?php
    }
    
    mysqli_close($conexion);

    
?>