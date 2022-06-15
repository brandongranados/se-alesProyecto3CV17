<?php
if (isset($_POST['idUsuario']) && $_POST['idRecompensa'] && $_POST['puntosCuesta']) {
    require_once "../conexion.php";

    $idUsuario=$_POST['idUsuario'];
    $idRecompensa=$_POST['idRecompensa'];
    $puntosCuesta=$_POST['puntosCuesta'];
    $estatus="no";

    $sql = "UPDATE recompensausuario set disponible = '$estatus' WHERE idRecompensa = '$idRecompensa' and idUsuario = '$idUsuario'";
    $result=mysqli_query($conexion,$sql);
    mysqli_close($conexion);
    if($result){
        header("location:./rewardUser.php");
    }else{
        echo "No se pudo canjear la tarea!";
    }
    header("location:rewardUser.php");
}
?>