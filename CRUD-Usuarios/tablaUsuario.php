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
    $resultado = mysqli_query($conexion,"SELECT u.idUsuario, u.email, u.nombreUsuario, u.foto  FROM usuarios u JOIN usuariodependiente ud ON u.idUsuario = ud.idUsuarioDep WHERE ud.idUsuario = '$idUsuario'");    
?>
  
<div class="row">
            <div class="col-sm-12">
              <h2 style="text-align: center;">Tareas</h2>
                <table class="table table-hover table-condensed table-bordered text-center">
                    <caption>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                            Agregar Nuevo Usuario
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </caption>
                    <tr class="PrincipalesT Uno">
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Eliminar</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($resultado)) {
                      $datas =$row['idUsuario']."||".$row['nombreUsuario']."||".$row['email']."||".$row['foto'];
                      ?>

                      <tr>
                        <td style="width:20%; vertical-align: middle;" valign="middle"><?php echo $row['nombreUsuario'];?></td>
                        <td style="width:30%; vertical-align: middle;" valign="middle"><?php echo $row['email']; ?></td>
                        <td style="width:20%; vertical-align: middle;"><img style="width:50%; height:60%;" src="<?php echo $row['foto']; ?>">
                        <td style="width:10%; vertical-align: middle;">
                            <button class="btn btn-danger glyphicon glyphicon-remove" data-toggle="modal" data-target="#modalEliminar" onclick="preguntarSiNo('<?php echo $datas ?>')"> </button>
                        </td>
                    <?php }?>
                </table>
            </div>
        </div>