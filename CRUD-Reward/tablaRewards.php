<?php
    session_start();
     include "conexion.php";
    $usuario = $_SESSION['correo'];
	$contraseña = $_SESSION['pass'];
    $consulta ="SELECT *FROM Recompensa";
    $resultado = mysqli_query($conexion, $consulta);
?>
  
<div class="row">
            <div class="col-sm-12">
              <h2>Recompensas</h2>
                <table class="table table-hover table-condensed table-bordered text-center">
                    <caption>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                            Agregar Nueva Recompensa
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </caption>
                    <tr class="PrincipalesT Uno">
                        <th>Nombre</th>
                        <th>Puntos que cuesta</th>
                        <th>Fecha de publicaci&oacute;n</th>
                        <th></th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($resultado)) {
                      $datas =$row['idRecompensa']."||".$row['nombreRecompensa']."||".$row['puntosCuesta']."||".$row['fechaHora'];
                      ?>

                      <tr>
                        <td style="width:30%; vertical-align: middle;" ><?php echo $row['nombreRecompensa']; ?></td>
                        <td style="width:14%; vertical-align: middle;"><?php echo $row['puntosCuesta']; ?></td>
                        <td style="width:20%; vertical-align: middle;"><?php echo $row['fechaHora']; ?></td>
                        <td style="width:30%; vertical-align: middle;"><img style="width:50%; height:60%;" src="<?php echo $row['foto']; ?>">
                        <td style="width:10%; vertical-align: middle;">
                            <button class="btn-warning btn glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datas ?>')">
                            </button>
                        </td>
                        <td style="width:10%; vertical-align: middle;">
                            <button class="btn btn-danger glyphicon glyphicon-remove" data-toggle="modal" data-target="#modalEliminar" onclick="preguntarSiNo('<?php echo $datas ?>')"> </button>
                        </td>
                    <?php }?>
                </table>
            </div>
        </div>