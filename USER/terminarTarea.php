<?php
if (isset($_POST['IdTarea']) && $_POST['status']) {
    require_once "../conexion.php";

    $idContratacion=$_POST['IdTarea'];
    $fecha_fin=date('Y-m-d');  
    $estatus="finalizado";

    $sql = "UPDATE tarearealizada set estatus= '$estatus' WHERE idTarea=$idContratacion";
    $result=mysqli_query($conexion,$sql);
    mysqli_close($conexion);
    if($result){
        header("location:./perfilUser.php");
    }else{
        echo "No se pudo terminar la tarea!";
    }
            
    
    echo 1;

} else {

    echo 2;
}
?>