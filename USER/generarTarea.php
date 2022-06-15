<?php
if (isset($_POST['idUsuario']) && $_POST['idTarea'] && $_POST['valorPuntos']) {
    require_once "../conexion.php";

    $idUsuario=$_POST['idUsuario'];
    $idTarea=$_POST['idTarea'];
    $valorPuntos=$_POST['valorPuntos'];
    $fecha_inicio=date('Y-m-d');  
    $estatus="activo";

    $sql = "INSERT INTO tarearealizada (idTarea,idUsuario,avancePuntos,estatus) VALUE (?,?,?,?)";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "iiis", $idTarea,$idUsuario,$valorPuntos,$estatus);
                if(mysqli_stmt_execute($stmt)){
                }else{
                    echo "ERROR";
                }
            }
    
    echo 1;

} else {

    echo 2;
}
?>