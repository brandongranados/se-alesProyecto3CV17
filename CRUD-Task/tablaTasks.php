<?php
    session_start();
     include "../conexion.php";
    $usuario = $_SESSION['correo'];
	$contraseña = $_SESSION['pass'];
    $consultauser = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$usuario'");
    $row = mysqli_num_rows($consultauser);
    if($row > 0){ 
        while($fila3 = mysqli_fetch_array($consultauser)) {
            $idUsuario= $fila3['idUsuario'];
        }
    }
    $resultado = mysqli_query($conexion,"SELECT *FROM tarea WHERE idUsuario = '$idUsuario'");    
?>
  
<div class="row">
            <div class="col-sm-12">
              <h2 style="text-align: center;">Tareas</h2>
                <table class="table table-hover table-condensed table-bordered text-center">
                    <caption>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                            Agregar Nueva Tarea
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </caption>
                    <tr class="PrincipalesT Uno">
                        <th>Nombre</th>
                        <th>Valor en Puntos</th>
                        <th>Fecha de publicaci&oacute;n</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($resultado)) {
                      $datas =$row['idTarea']."||".$row['nombreTarea']."||".$row['valorPuntos']."||".$row['fechaHora'];
                      ?>

                      <tr>
                        <td style="width:30%;" valign="middle"><?php echo $row['nombreTarea']; ?></td>
                        <td style="width:14%;" valign="middle"><?php echo $row['valorPuntos']; ?></td>
                        <td style="width:20%;" valign="middle"><?php echo $row['fechaHora']; ?></td>
                        <td style="width:10%;">
                            <button class="btn-warning btn glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datas ?>')">
                            </button>
                        </td>
                        <td style="width:10%;">
                            <button class="btn btn-danger glyphicon glyphicon-remove" data-toggle="modal" data-target="#modalEliminar" onclick="preguntarSiNo('<?php echo $datas ?>')"> </button>
                        </td>
                    <?php }?>
                </table>
            </div>
        </div>