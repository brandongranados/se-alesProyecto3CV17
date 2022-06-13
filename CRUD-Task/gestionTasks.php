<?php
	session_start();
	require_once "../conexion.php";
	
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
<header class="encabe">
        <div class="Logo">
            <a class="navText" href="./homeUser.php"><img src="./static/images/Logo.png" class="logito" alt="Logo"></a>    
        </div>
        <nav>
            <li><a class="navText" href="./perfilUser.php"><span > Perfil </span></a></li>    
            <li><a class="navText" href="../USER/homeUser.php"><span > Tareas </span></a></li>    
            <li><a class="navText" href="../USER/rewardUser.php"><span > Recompensas </span></a></li>    
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
          <form  action="tasks.php"  method="post">
              <label></label>
              <label>Nombre de la tarea</label>
              <input type="text" name="nombre" id="nombre"  maxlength="100" required>
              <label>Puntos por hacer la tarea</label>
              <input type="number" name="valor" id="valor"  required>  
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Agregar">
        </form>
        </div>
      </div>
    </div>
  </div>

   <!-- Modal para edicion de datos -->
  <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Editar una Tarea</h4>
        </div>
        <div class="modal-body">
          <form  action="modificarTask.php"  method="post">
              <input type="text" hidden=""  id="ids" name="idTasks">
              <label>Nombre de la tarea</label>
              <input type="text" id="nombre" name="nombre" class="uwu sin_borde"  required >    
              <label>Puntos por hacer la tarea</label>
              <input type="number" name="valor" id="valor" class="form-control input-sm" required>
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-warning" value="Modificar">
        </div>
        </form>
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
        <form  action="eliminarTask.php"  method="post">
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
  <footer>
        <div class="bajo bg-primary py-3 d-flex align-items-center contenedor-footer w-100">
        <span class="w-100 text-center">Nombre del proyecto &copy; 2022</span>
        </div>
    </footer>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('./tablaTasks.php');
	});
</script>