<?php
	session_start();
	require_once "../conexion.php";
	$tipoUser = $_SESSION['tipoUser'];
	$usuario = $_SESSION['correo'];
	$contraseña = $_SESSION['pass'];
  
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Tasks</title>
	<link rel="stylesheet" type="text/css" href="../static/librerias/bootstrap/css/bootstraps.css">
	<link rel="stylesheet" type="text/css" href="../static/librerias/alertifyjs/css/alertify.css">
	<script src="../static/js/funciones.js"></script>
	<link rel="stylesheet" type="text/css" href="../static/librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="../static/librerias/select2/css/select2.css">
  <link href="../static/css/agregar.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" type="image/ico" href="../static/images/icono.ico">
	<link href="../static/css/navegacion.css" rel="stylesheet" type="text/css">
	<script src="../static/librerias/jquery-3.2.1.min.js"></script>
	<script src="../static/librerias/bootstrap/js/bootstrap.js"></script>
	<script src="../static/librerias/alertifyjs/alertify.js"></script>
  	<script src="../static/librerias/select2/js/select2.js"></script>
	<script src="../static/alert/package/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<script src="./static/alert/package/dist/sweetalert2.all.min.js"></script>
<header class="encabe">
        <div class="Logo">
            <a class="navText" href="./homeUser.php"><span>HOME</span></a>    
        </div>
        <nav>
            <li><a class="navText" href="../USER/perfilUser.php"><span > Perfil </span></a></li>    
            <li><a class="navText" href="<?php if($tipoUser == "Admin"){echo "../CRUD-Task/gestionTasks.php";}else{echo "../USER/taskUser.php";}?>"><span > Tareas </span></a></li>    
            <li><a class="navText" href="<?php if($tipoUser == "Admin"){echo "../CRUD-Reward/gestionRewards.php";}else{echo "../USER/rewardUser.php";}?>"><span > Recompensas </span></a></li> 
            <li><a class="navText" href="../cerrarSesion.php"><span > Cerrar sesi&oacute;n </span></a></li>
        </nav>
    </header>
<br>
<div class="container">
      <div id="buscador"></div>
		  <div id="tabla"></div>
    </div>
	<!--Modal para agregar datos -->
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Agrega nuevo Task</h4>
        </div>
        <div class="modal-body">
          <form  action="usuario.php"  method="post">
              <label></label>
              <label>Email del usuario dependiente</label>
              <input type="email" name="nombre" id="nombre"  maxlength="100" required>
            
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Agregar">
        </form>
        </div>
      </div>
    </div>
  </div>
  <!--Modal para eliminar de datos -->
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">¿Quieres eliminar esta tarea?</h4>
        </div>
        <div class="modal-body">
        <form  action="eliminarUsuario.php"  method="post">
            <input type="text" hidden=""  id="ids1" name="idTasks">
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Si quiero eliminarlo">
        </form> 
        </div>
      </div>
    </div>
  </div>
  <br>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('./tablaUsuario.php');
	});
</script>